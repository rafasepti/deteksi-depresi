<?php

namespace App\Http\Controllers;

use App\Models\Depresi;
use App\Models\Gejala;
use App\Models\GejalaDepresi;
use App\Models\HasilDiagnosa;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Classification\NaiveBayes;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $pasien = Pasien::with('user')
            ->where('user_id', Auth::id())
            ->first();
        $pertanyaan = Gejala::orderBy('id', 'asc')->paginate(8);
        return view('pasien.diagnosa.tes_depresi', compact('pasien', 'pertanyaan'));
    }

    public function storeAnswers(Request $request)
    {
        $answers = $request->except('_token', 'page'); // Mendapatkan semua input form kecuali token CSRF dan halaman
        $page = $request->input('page'); // Mendapatkan halaman saat ini atau halaman tujuan

        foreach ($answers as $key => $value) {
            session()->put($key, $value); // Menyimpan setiap jawaban ke dalam session
        }

        if ($request->has('btn_submit')) {
            // Ambil semua data dari session
            $answers = session()->all();

            // Filter hanya jawaban gejala
            $gejalaAnswers = array_filter($answers, function($key) {
                return strpos($key, 'gejala_') === 0;
            }, ARRAY_FILTER_USE_KEY);

            // Cek apakah lebih dari 2/3 jawaban adalah 0
            $totalGejala = count($gejalaAnswers);
            $jumlahJawaban0 = count(array_filter($gejalaAnswers, function($value) {
                return $value == 0;
            }));

            if ($totalGejala > 0 && $jumlahJawaban0 / $totalGejala > 2/3) {
                $depresi = Depresi::where('tingkat_depresi', 'Tidak Depresi')->first();
                $this->saveOrUpdateDiagnosa(Auth::id(), $depresi ? $depresi->id : '0');
                session()->forget(array_keys($gejalaAnswers));
                return redirect()->route('pasien.diagnosa.result')
                                ->with(['depresiLevelNaiveBayes' => 'Tidak Depresi', 'depresiLevelKNN' => 'Tidak Depresi']);
            }

            // Convert answers to sample format
            $sample = $this->prepareSample($gejalaAnswers);

            // Hitung tingkat depresi
            $depresiLevels = $this->calculateDepresi($sample);
            $depresiLevelNaiveBayes = $depresiLevels['depresiLevelNaiveBayes'];
            $depresiLevelKNN = $depresiLevels['depresiLevelKNN'];

            // Simpan atau update hasil diagnosa
            $this->saveOrUpdateDiagnosa(Auth::id(), $depresiLevelNaiveBayes);

            // Hapus data gejala dari session
            session()->forget(array_keys($gejalaAnswers));

            // Redirect ke halaman hasil diagnosa
            return redirect()->route('pasien.diagnosa.result');
        }

        return redirect()->route('pasien.diagnosa', ['page' => $page]);
    }
    
    public function showResult()
    {
        $hasil_diagnosa = HasilDiagnosa::with('depresi')->where('user_id', Auth::id())->first();
        return view('pasien.diagnosa.hasil', compact('hasil_diagnosa'));
    }

    public function calculateDepresi($sample)
    {
        $depresiLevelNaiveBayes = $this->calculateDepresiLevelWithNaiveBayes($sample);
        $depresiLevelKNN = $this->calculateDepresiLevelWithKNN($sample);

        return compact('depresiLevelNaiveBayes', 'depresiLevelKNN');
    }

    public function saveOrUpdateDiagnosa($userId, $depresiLevelNaiveBayes)
    {
        $hasil_diagnosa = HasilDiagnosa::with('depresi')->where('user_id', $userId)->first();

        if($hasil_diagnosa){
            $hasil_diagnosa->update([
                'depresi_id' => $depresiLevelNaiveBayes,
            ]);
        }else{
            HasilDiagnosa::create([
                'user_id' => $userId,
                'depresi_id' => $depresiLevelNaiveBayes,
            ]);
        }
    }

    private function calculateDepresiLevelWithNaiveBayes($sample)
    {
        $samples = $this->getSamples();
        $labels = $this->getLabels();

        // dd($sample, $samples, $labels);

        $classifier = new NaiveBayes();
        $classifier->train($samples, $labels);

        $predictedLabel = $classifier->predict($sample);

        return $predictedLabel;
    }

    private function calculateDepresiLevelWithKNN($sample)
    {
        $samples = $this->getSamples();
        $labels = $this->getLabels();

        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        // dd($sample, $samples, $labels);

        $predictedLabel = $classifier->predict($sample);

        return $predictedLabel;
    }

    private function getSamples()
    {
        // Mengambil data dari tabel gejala_depresi dan mengubahnya menjadi format sampel
        $gejalaDepresi = GejalaDepresi::all();
        $gejalaCount = Gejala::count();

        $samples = [];
        $currentSample = array_fill(0, $gejalaCount, 0);
        $currentDepresiId = 1;
        $index = 0;

        foreach ($gejalaDepresi as $item) {
            if ($item->depresi_id != $currentDepresiId) {
                // Simpan sample jika sudah pindah ke depresi_id yang berbeda
                $samples[$currentDepresiId - 1] = $currentSample; // Simpan sample ke indeks yang sesuai
                $currentSample = array_fill(0, $gejalaCount, 0);
                $currentDepresiId = $item->depresi_id;
                $index = 0;
            }
            $currentSample[$index++] = 1; // Set nilai gejala yang ada
        }
        // Add the last sample
        $samples[$currentDepresiId - 1] = $currentSample;

        return $samples;
    }

    private function getLabels()
    {
        // Ambil label dari tabel depresi
        $gejalaDepresi = GejalaDepresi::all();
        $labels = [];
        $currentDepresiId = 1;

        foreach ($gejalaDepresi as $item) {
            if ($item->depresi_id != $currentDepresiId) {
                // Simpan label jika sudah pindah ke depresi_id yang berbeda
                $labels[] = Depresi::find($currentDepresiId)->id;
                $currentDepresiId = $item->depresi_id;
            }
        }
        // Add the last label
        $labels[] = Depresi::find($currentDepresiId)->id;

        return $labels;
    }

    private function prepareSample($answers)
    {
        $gejalaCount = Gejala::count();
        $sample = array_fill(0, $gejalaCount, 0);

        foreach ($answers as $key => $value) {
            $gejalaId = (int)str_replace('gejala_', '', $key) - 1; // Ubah indeks ke format numerik
            $sample[$gejalaId] = (int)$value; // Ubah nilai ke format numerik
        }

        return $sample;
    }
}
