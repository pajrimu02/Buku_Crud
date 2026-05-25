@extends('layouts.template')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Detail Buku</h2>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Informasi Buku
        </div>

        <div class="card-body">

            <div class="row">

                {{-- KIRI --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <small class="text-muted">Judul Buku</small>
                        <div class="fw-bold">{{ $detailBuku->judul }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Penulis</small>
                        <div class="fw-bold">{{ $detailBuku->penulis }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Tahun Terbit</small>
                        <div class="fw-bold">{{ $detailBuku->tahun_terbit }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Kategori</small>
                        <div>
                            <span class="fw-bold text-dark">
                                {{ $detailBuku->kategori->nama_kategori ?? '-' }}
                            </span>
                        </div>
                    </div>

                </div>

                {{-- KANAN --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <small class="text-muted">ISBN</small>
                        <div class="fw-bold">{{ $detailBuku->detail->isbn ?? '-' }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Jumlah Halaman</small>
                        <div class="fw-bold">
                            {{ $detailBuku->detail->jumlah_halaman ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Harga</small>
                        <div class="fw-bold text-success">
                            Rp {{ number_format($detailBuku->harga, 0, ',', '.') }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">
            <a href="{{ route('buku') }}" class="btn btn-secondary btn-sm bg-primary text-white">
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection