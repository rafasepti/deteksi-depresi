<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDiagnosa extends Model
{
    use HasFactory;
    protected $table = "hasil_diagnosa";
    protected $guarded = ['created_at', 'updated_at'];

    public function depresi()
    {
        return $this->belongsTo(Depresi::class, 'depresi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
