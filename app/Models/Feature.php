<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'brut_metrekare',
        'net_metrekare',
        'oda_sayisi',
        'salon_sayisi',
        'banyo_sayisi',
        'kat',
        'isitma_tipi',
        'esya_durumu',
        'manzara',
        'balkon',
        'teras',
        'cephe',
        'post_id',
    ];
}
