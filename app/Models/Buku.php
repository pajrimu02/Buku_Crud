<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    //inisialisasi table
    protected $table = 'buku';

    //inisialisasi PK
    protected $primaryKey = 'id';

    //inisialisasi kolom yang dapat diisi
    //protected $fillable = ['judul','penulis', 'harga','tahun_terbit'];

    //inisialisasi kolom yang tidak boleh diisi
    protected $guarded = ['id'];

    public function detail(){
        return $this->hasOne(DetailBuku::class, 'buku_id', 'id');
    }

    public function kategori()
    {
        # 1 buku milik 1 kategori (inverse)        
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');        
    }    
}

