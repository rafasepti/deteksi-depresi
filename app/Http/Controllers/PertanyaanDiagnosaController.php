<?php

namespace App\Http\Controllers;

use App\Models\PertanyaanDiagnosa;
use App\Http\Requests\StorePertanyaanDiagnosaRequest;
use App\Http\Requests\UpdatePertanyaanDiagnosaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class PertanyaanDiagnosaController extends Controller
{
    public function index(){
        return view('admin.pertanyaan.v_pertanyaan');
    }

    public function dataTable(Request $request){
        if ($request->ajax()) {
            $pertanyaan = PertanyaanDiagnosa::all();
            return DataTables::of($pertanyaan)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = 
                    '
                        <a href="/pertanyaan/edit/'.$data->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/pertanyaan/hapus/'.$data->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
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
        return view('admin.pertanyaan.tambah_pertanyaan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required'],
        ]);

        PertanyaanDiagnosa::create([
            'pertanyaan' => $request->pertanyaan,
        ]);

        return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil ditambahkan!');
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
        $pertanyaan = PertanyaanDiagnosa::where('id', $id)
            ->first();
        return view('admin.pertanyaan.edit_pertanyaan', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required'],
        ]);

        PertanyaanDiagnosa::where('id', $request->id)->update([
            'pertanyaan' => $request->pertanyaan,
        ]);

        return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PertanyaanDiagnosa::where('id', $id)->delete();
        
        return Redirect::route('admin.pertanyaan')->with('success', 'Data berhasil dihapus!');
    }
}
