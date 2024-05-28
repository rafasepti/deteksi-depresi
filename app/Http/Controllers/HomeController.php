<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Depresi;
use App\Models\HasilDiagnosa;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function indexPasien(){
        $hasil_diagnosa = HasilDiagnosa::with('depresi')
            ->where('user_id', Auth::id())
            ->first();
        return view('pasien.index', compact('hasil_diagnosa'));
    }

    public function indexAdmin(){
        $pasien_count = Pasien::count();
        $admin_count = Admin::count();
        // Dapatkan semua tingkat depresi
        $allDepresi = Depresi::all();

        // Dapatkan hitungan dari tabel HasilDiagnosa
        $hasilDiagnosaCounts = HasilDiagnosa::selectRaw('depresi_id, COUNT(*) as count')
            ->groupBy('depresi_id')
            ->pluck('count', 'depresi_id');

        // Konversi hasil ke array
        $hasilDiagnosaCounts = $hasilDiagnosaCounts->toArray();

        // Gabungkan dengan semua tingkat depresi
        $depresiSummary = [];
        foreach ($allDepresi as $depresi) {
            $depresiSummary[] = [
                'depresi_id' => $depresi->id,
                'tingkat_depresi' => $depresi->tingkat_depresi,
                'count' => $hasilDiagnosaCounts[$depresi->id] ?? 0
            ];
        }
        return view('admin.index', compact('pasien_count', 'admin_count', 'depresiSummary'));
    }
}
