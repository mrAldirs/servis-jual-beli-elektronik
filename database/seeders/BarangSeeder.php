<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Televisi Polytron', 'jenis' => 'TV', 'status' => 'Jual', 'foto' => 'polytron.jpg', 'keterangan' => 'Barang masih bagus.'],
            ['nama' => 'Laptop Acer', 'jenis' => 'Laptop', 'status' => 'Jual', 'foto' => 'acer.jpg', 'keterangan' => 'Barang mulus, belum pernah servis sebelumnya.']
        ];

        foreach ($data as $value) {
            Barang::insert([
                'id' => Uuid::uuid4(),
                'nama' => $value['nama'],
                'jenis' => $value['jenis'],
                'status' => $value['status'],
                'foto' => $value['foto'],
                'keterangan' => $value['keterangan'],
                'created_at' => date('Y-m-d H-i-s')
            ]);
        }
    }
}
