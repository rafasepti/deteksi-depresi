<?php

namespace App\Http\Controllers;

use App\Models\Depresi;
use App\Models\Gejala;
use App\Models\GejalaDepresi;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->route('pasien.diagnosa.result');
        }

        return redirect()->route('pasien.diagnosa', ['page' => $page]);
    }
    
    public function showResult()
    {
        $answers = session()->all();

        // Filter hanya jawaban gejala
        $gejalaAnswers = array_filter($answers, function($key) {
            return strpos($key, 'gejala_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        // Convert answers to sample format
        $sample = $this->prepareSample($gejalaAnswers);

        //dd($sample);

        // Hitung tingkat depresi dengan Naive Bayes
        $depresiLevelNaiveBayes = $this->calculateDepresiLevelWithNaiveBayes($sample);

        // Hitung tingkat depresi dengan KNN
        $depresiLevelKNN = $this->calculateDepresiLevelWithKNN($sample);

        return view('pasien.diagnosa.hasil', compact('depresiLevelNaiveBayes', 'depresiLevelKNN'));
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
                $labels[] = Depresi::find($currentDepresiId)->tingkat_depresi;
                $currentDepresiId = $item->depresi_id;
            }
        }
        // Add the last label
        $labels[] = Depresi::find($currentDepresiId)->tingkat_depresi;

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
