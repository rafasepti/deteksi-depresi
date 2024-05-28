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


    public function show()
    {
        $hasil_diagnosa = HasilDiagnosa::with('depresi')
                ->with('user')
                ->first();
        $pasien = Pasien::where('user_id', $hasil_diagnosa->user_id)->first();
        return view('admin.pasien.detail', compact('hasil_diagnosa', 'pasien'));
    }

    public function report($bln)
    {
        $bulan = [
            'januari' => 1,
            'februari' => 2,
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'desember' => 12
        ];
    
        // Dapatkan angka bulan dari nama bulan
        $monthNumber = $bulan[strtolower($bln)] ?? null;
    
        if ($monthNumber) {
            $hasil_diagnosa = HasilDiagnosa::with('depresi')
                ->with('user')
                ->whereMonth('updated_at', $monthNumber)
                ->get();
        } else {
            // Jika nama bulan tidak valid, kembalikan hasil kosong atau semua data
            $hasil_diagnosa = HasilDiagnosa::with('depresi')
                ->with('user')
                ->get();
        }
        return view('admin.pasien.report', compact('hasil_diagnosa'));
    }
}
