<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'tel_1',
        'tel_2',
        'fiyat',
        'kategori',
        'emlak_turu',
        'yayin_tipi',
        'user_id',
    ];

    public function toSearchableArray() {
       return [
            'title' => $this->title,
            'description' => $this->description,
            'emlak_turu' => $this->emlak_turu,
            'yayin_tipi' => $this->yayin_tipi,
       ]; 
    }
}
