<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gejala extends Model
{
    use HasFactory;
    protected $table = "gejala";
    protected $guarded = ['created_at', 'updated_at'];

    public static function kodeGejala(){
        $lastGejala = DB::table('gejala')->select('kode_gejala')->orderBy('id', 'desc')->first();

        if ($lastGejala) {
            $lastCode = $lastGejala->kode_gejala;
            $lastNumber = (int) substr($lastCode, 3); // Ambil angka setelah 'GD-'
            $nextNumber = $lastNumber + 1;
            $nextCode = 'GD-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada gejala sebelumnya, gunakan nomor awal
            $nextCode = 'GD-001';
        }

        return $nextCode;
    }
}
