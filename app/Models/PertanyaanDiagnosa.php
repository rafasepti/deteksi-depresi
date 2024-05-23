<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanDiagnosa extends Model
{
    use HasFactory;
    protected $table = "pertanyaan_diagnosa";
    protected $guarded = ['created_at', 'updated_at'];
}
