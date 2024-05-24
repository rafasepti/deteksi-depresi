<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Depresi extends Model
{
    use HasFactory;
    protected $table = "depresi";
    protected $guarded = ['created_at', 'updated_at'];

    public static function kodeDepresi(){
        $lastDepresi = DB::table('depresi')->select('kode_depresi')->orderBy('id', 'desc')->first();

        if ($lastDepresi) {
            $lastCode = $lastDepresi->kode_depresi;
            $lastNumber = (int) substr($lastCode, 3); // Ambil angka setelah 'GD-'
            $nextNumber = $lastNumber + 1;
            $nextCode = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada depresi sebelumnya, gunakan nomor awal
            $nextCode = 'DP-001';
        }

        return $nextCode;
    }
}
