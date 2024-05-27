<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GejalaDepresi extends Model
{
    use HasFactory;
    protected $table = "gejala_depresi";
    protected $guarded = ['created_at', 'updated_at'];

    public function gejala()
    {
        return $this->belongsToMany(Gejala::class, 'gejala_depresi', 'depresi_id', 'gejala_id')->withPivot('value');
    }

    public function depresi()
    {
        return $this->belongsTo(Depresi::class, 'depresi_id');
    }
}
