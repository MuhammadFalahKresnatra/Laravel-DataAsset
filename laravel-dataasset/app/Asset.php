<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Asset extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'asset',
        'idkategori',
        'merk',
        'tahunbeli',
        'harga',
        'umurekonomis',
        'nilairesidu',
        'spek',
        'latitude',
        'longtitude',
    ];

}
