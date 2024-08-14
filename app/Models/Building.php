<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bina_yasi',
        'kat_sayisi',
        'kullanim_durumu',
        'hasar_durumu',
        'guvenlik',
        'asansor',
        'otopark',
        'post_id',
    ];
}
