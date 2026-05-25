@extends('layouts.template')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">
        {{ isset($detailBuku) ? 'Edit Buku' : 'Tambah Buku' }}
    </h2>

    <div class="card shadow-sm">

        <div class="card-header fw-bold">
            Form Buku
        </div>

        <div class="card-body">

            <form method="POST"
                action="{{ isset($detailBuku) ? route('update-buku', $detailBuku->id) : route('store') }}">

                @csrf
                @if(isset($detailBuku))
                    @method('PUT')
                @endif

                <div class="row">

                    {{-- JUDUL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul"
                            value="{{ old('judul', $detailBuku->judul ?? '') }}">
                        @error('judul')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>

                        <select class="form-select" name="kategori_id">
                            <option value="">-- pilih kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kategori_id', $detailBuku->kategori_id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- ISBN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn"
                            value="{{ old('isbn', $detailBuku->detail->isbn ?? '') }}">

                        @error('isbn')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    {{-- JUMLAH HALAMAN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" name="jumlah_halaman"
                            value="{{ old('jumlah_halaman', $detailBuku->detail->jumlah_halaman ?? '') }}">

                        @error('jumlah_halaman')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- PENULIS --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="penulis"
                            value="{{ old('penulis', $detailBuku->penulis ?? '') }}">

                        @error('penulis')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- TAHUN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit"
                            value="{{ old('tahun_terbit', $detailBuku->tahun_terbit ?? '') }}">

                        @error('tahun_terbit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- HARGA --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga"
                            value="{{ old('harga', $detailBuku->harga ?? '') }}">

                        @error('harga')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>
    </div>
</div>
@endsection