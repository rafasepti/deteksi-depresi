<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GejalaGangguan extends Model
{
    use HasFactory;
    protected $table = "gejala_gangguan";
    protected $guarded = ['created_at', 'updated_at'];
}
