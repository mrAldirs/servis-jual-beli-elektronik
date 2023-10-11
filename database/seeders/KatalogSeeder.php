<?php

namespace Database\Seeders;

use App\Models\Katalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class KatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['barang_id' => '57e6e89c-247e-4213-abb3-1f959db583e4', 'spesifikasi' => 'Bisa Conect WIFI', 'harga' => '6000000', 'status' => 'Tersedia'],
            ['barang_id' => '5a9d104d-9fdc-4667-ac23-f58f4bd4ff74', 'spesifikasi' => 'RAM 8 Intel Core 7 5000G', 'harga' => '7500000', 'status' => 'Tersedia']
        ];

        foreach ($data as $value) {
            Katalog::insert([
                'id' => Uuid::uuid4(),
                'barang_id' => $value['barang_id'],
                'spesifikasi' => $value['spesifikasi'],
                'harga' => $value['harga'],
                'status' => $value['status'],
                'created_at' => date('Y-m-d H-i-s')
            ]);
        }
    }
}
