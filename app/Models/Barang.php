<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasUuids;

    use HasFactory;
    protected $table = 'barangs';
    protected $fillable = [
        'nama',
        'jenis',
        'status',
        'foto',
        'keterangan'
    ];


    /**
     * Get all of the katalogBarang for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function katalogBarangs()
    {
        return $this->hasMany(Katalog::class, 'barang_id', 'id');
    }
}
