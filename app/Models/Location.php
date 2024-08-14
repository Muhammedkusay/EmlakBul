<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Location extends Model
{
    use HasFactory, Searchable;
    
    protected $fillable = [
        'il',
        'ilce',
        'mahalle',
        'adres',
        'lat',
        'lng',
        'post_id',
    ];

    public function toSearchableArray() {
        return [
            'il' => $this->il,
            'ilce' => $this->ilce,
            'mahalle' => $this->mahalle,
        ];
    }
}
