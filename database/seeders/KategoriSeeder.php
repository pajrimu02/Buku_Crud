<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = [
            'Multimedia',
            'Database Design',
            'Web Programming',
            'Mobile Development',
            'Networking',
            'Artificial Intelligence',
        ];

        foreach ($kategoriList as $kategori) {
            DB::table('kategori')->insert([
                'nama_kategori' => $kategori,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}