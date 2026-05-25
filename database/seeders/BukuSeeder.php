<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $judulBuku = [
            "Dasar-Dasar Pemrograman PHP untuk Pemula",
            "Belajar PHP dari Nol hingga Mahir",
            "PHP OOP: Konsep dan Implementasi",
            "Framework PHP untuk Pengembangan Web Cepat",
            "Pemrograman Backend Profesional dengan PHP",
            "Studi Kasus Pengembangan Sistem Informasi dengan PHP",
            "Tips dan Trik Coding Efektif Menggunakan PHP"
        ]; 

        $data = [];
        for($i=0; $i<50; $i++){
            $data[]= [
                        'judul'         => $faker->randomElement($judulBuku),
                        'penulis'       => $faker->name,
                        'harga'         => $faker->numberBetween(50000, 200000),
                        'tahun_terbit'  => $faker->year(),
                        'created_at'    => now(),	
                        'updated_at'    => now(),	
                        'kategori_id'   => DB::table('kategori')->inRandomOrder()->value('id'),	
            ];
        }
        DB::table('buku')->insert($data);
        //DB::table('buku')->delete();
    }
}
