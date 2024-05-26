<?php

namespace App\Http\Controllers;

use App\Models\Depresi;
use App\Http\Requests\StoreDepresiRequest;
use App\Http\Requests\UpdateDepresiRequest;
use App\Models\Gejala;
use App\Models\GejalaDepresi;
use App\Models\GejalaGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class DepresiController extends Controller
{
    public function index(){
        return view('admin.depresi.v_depresi');
    }

    public function dataTable(Request $request){
        if ($request->ajax()) {
            $depresi = Depresi::all();
            return DataTables::of($depresi)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = 
                    '
                        <a href="/gangguan/gejala/'.$data->id.'" class="btn btn-primary btn-sm">
                            Gejala
                        </a>
                        <a href="/gangguan/edit/'.$data->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/gangguan/hapus/'.$data->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
                            Hapus
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode = Depresi::kodeDepresi();
        return view('admin.depresi.tambah_depresi', compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_depresi' => ['required', 'string', 'max:100'],
            'tingkat_depresi' => ['required'],
        ]);

        depresi::create([
            'kode_depresi' => $request->kode_depresi,
            'tingkat_depresi' => $request->tingkat_depresi,
        ]);

        return Redirect::route('admin.depresi')->with('success', 'Data berhasil ditambahkan!');
    }

    public function gejala($id)
    {
        // Ambil data tingkat depresi
        $depresi = Depresi::findOrFail($id);
        $gejalaDepresi = GejalaDepresi::where('depresi_id', $id)->pluck('gejala_id')->toArray();
        $gejala = Gejala::all();
        return view('admin.depresi.gejala', compact('depresi', 'gejala', 'gejalaDepresi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function gejalaStore(Request $request)
    {
        // Validasi request
        $request->validate([
            'gejala_id' => 'required|array',
            'depresi_id' => 'required|exists:depresi,id',
        ]);

        // Ambil depresi_id dari request
        $depresi_id = $request->input('depresi_id');

        // Ambil gejala_id yang dipilih dari request
        $gejala_ids = $request->input('gejala_id');

        // Hapus data gejala yang tidak dipilih lagi
        GejalaDepresi::where('depresi_id', $depresi_id)
            ->whereNotIn('gejala_id', $gejala_ids)
            ->delete();

        // Simpan atau tambahkan data yang dipilih
        foreach ($gejala_ids as $gejala_id) {
            // Cek apakah item sudah ada dalam database
            $existingRecord = GejalaDepresi::where('depresi_id', $depresi_id)
                ->where('gejala_id', $gejala_id)
                ->first();

            // Jika item belum ada, tambahkan ke database
            if (!$existingRecord) {
                $gejalaDepresi = new GejalaDepresi();
                $gejalaDepresi->depresi_id = $depresi_id;
                $gejalaDepresi->gejala_id = $gejala_id;
                $gejalaDepresi->save();
            }
        }

        return Redirect::route('admin.depresi')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $depresi = Depresi::where('id', $id)
            ->first();
        return view('admin.depresi.edit_depresi', compact('depresi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'kode_depresi' => ['required', 'string', 'max:100'],
            'tingkat_depresi' => ['required'],
        ]);

        depresi::where('id', $request->id)->update([
            'kode_depresi' => $request->kode_depresi,
            'tingkat_depresi' => $request->tingkat_depresi,
        ]);

        return Redirect::route('admin.depresi')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        depresi::where('id', $id)->delete();
        GejalaDepresi::where('depresi_id', $id)->delete();
        
        return Redirect::route('admin.depresi')->with('success', 'Data berhasil dihapus!');
    }
}
