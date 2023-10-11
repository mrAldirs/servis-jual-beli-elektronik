<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasUuids;
    use HasFactory;
    protected $table = 'katalogs';
    protected $fillable = [
        'barang_id',
        'spesifikasi',
        'harga',
        'status'
    ];

    /**
     * Get the barang that owns the Katalog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
