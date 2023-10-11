<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $table = 'barangs';
    public $fillable = [
        'nama',
        'jenis',
        'status',
        'foto',
        'keterangan'
    ];
}
