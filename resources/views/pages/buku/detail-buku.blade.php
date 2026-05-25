@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <h1>Halaman Detail Buku</h1>
        <div class="card">
            <div class="card-header">Detail Buku</div>
            <div class="card-body">
                <p>Judul Buku: {{ $detailBuku->judul }}</p>
                <p>ISBN: {{ $detailBuku->detail->isbn ?? '-' }}</p>
                <p>Jumlah Halaman: {{ $detailBuku->detail->jumlah_halaman ?? '-' }}</p>
                <p>Penulis: {{ $detailBuku->penulis }}</p>
                <p>Tahun Terbit: {{ $detailBuku->tahun_terbit }}</p>
                <p>Harga: {{ $detailBuku->harga }}</p>
                <p>Kategori: {{ $detailBuku->kategori->nama_kategori }}</p>
            </div>
        </div>
    </div>
@endsection
