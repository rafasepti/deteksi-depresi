<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Http\Requests\StoreDiagnosaRequest;
use App\Http\Requests\UpdateDiagnosaRequest;
use App\Models\Gejala;
use App\Models\Pasien;
use App\Models\PertanyaanDiagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('pasien.diagnosa', ['page' => $page]); // Redirect ke halaman yang sesuai
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiagnosaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiagnosaRequest $request, Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosa $diagnosa)
    {
        //
    }
}
