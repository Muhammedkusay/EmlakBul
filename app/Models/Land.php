<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $fillable = [
        'arsa_alani',
        'imar_durumu',
        'yol_durumu',
        'altyapi_durumu',
        'manzara',
        'arazi_egimi',
        'hukuki_durumu',
        'pazarlik_durumu',
        'post_id',
    ];
}
