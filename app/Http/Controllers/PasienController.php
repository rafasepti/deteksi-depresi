<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Models\HasilDiagnosa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pasien.v_pasien');
    }

    public function dataTable(Request $request){
        if ($request->ajax()) {
            $pertanyaan = HasilDiagnosa::with('depresi')
                ->with('user')
                ->get();
            return DataTables::of($pertanyaan)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = 
                    '
                        <a href="/pasien/detail/'.$data->user_id.'" class="btn btn-info btn-sm">
                            Detail
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function show($id)
    {
        $hasil_diagnosa = HasilDiagnosa::with('depresi')
                ->with('user')
                ->where('user_id', $id)
                ->first();
        $pasien = Pasien::where('user_id', $hasil_diagnosa->user_id)->first();
        return view('admin.pasien.detail', compact('hasil_diagnosa', 'pasien'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
        ]);

        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $hasil_diagnosa = HasilDiagnosa::with('depresi', 'user')
            ->whereBetween('updated_at', [$tgl_awal, $tgl_akhir])
            ->get();

        return view('admin.pasien.report', compact('hasil_diagnosa', 'tgl_awal', 'tgl_akhir'));
    }
}
