<?php

namespace App\Http\Controllers;

use App\Models\HasilDiagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePasienController extends Controller
{
    public function index(){
        $hasil_diagnosa = HasilDiagnosa::with('depresi')
            ->where('user_id', Auth::id())
            ->first();
        return view('pasien.index', compact('hasil_diagnosa'));
    }
}
