<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Http\Requests\StoreGejalaRequest;
use App\Http\Requests\UpdateGejalaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class GejalaController extends Controller
{
    public function index(){
        return view('admin.gejala.v_gejala');
    }

    public function dataTable(Request $request){
        if ($request->ajax()) {
            $gejala = Gejala::all();
            return DataTables::of($gejala)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = 
                    '
                        <a href="/gejala/edit/'.$data->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/gejala/hapus/'.$data->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
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
        $kode = Gejala::kodeGejala();
        return view('admin.gejala.tambah_gejala', compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => ['required', 'string', 'max:100'],
            'nama_gejala' => ['required'],
        ]);

        Gejala::create([
            'nama_gejala' => $request->nama_gejala,
            'kode_gejala' => $request->kode_gejala,
        ]);

        return Redirect::route('admin.gejala')->with('success', 'Data berhasil ditambahkan!');
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
        $gejala = Gejala::where('id', $id)
            ->first();
        return view('admin.gejala.edit_gejala', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'kode_gejala' => ['required', 'string', 'max:100'],
            'nama_gejala' => ['required'],
        ]);

        Gejala::where('id', $request->id)->update([
            'nama_gejala' => $request->nama_gejala,
            'kode_gejala' => $request->kode_gejala,
        ]);

        return Redirect::route('admin.gejala')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gejala::where('id', $id)->delete();
        
        return Redirect::route('admin.gejala')->with('success', 'Data berhasil dihapus!');
    }
}
