<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;

class DetailBukuSeeder extends Seeder
{
    public function run(): void
    {
        $bukus = Buku::all();

        foreach ($bukus as $index => $buku) {
            DB::table('detail_buku')->updateOrInsert(
                ['buku_id' => $buku->id],
                [
                    'isbn' => 'ISBN-' . $buku->id,
                    'jumlah_halaman' => rand(100, 500),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}