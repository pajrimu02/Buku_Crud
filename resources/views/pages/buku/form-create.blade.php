@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <h1>Form Buku</h1>
        <div class="card">
            <div class="card-header fw-bold">
                {{ isset($detailBuku) ? 'Edit Buku' : 'Tambah Buku' }}
            </div>
            <div class="card-body">

                <form method="POST"
                    action="{{ isset($detailBuku) ? route('update-buku', ['id' => $detailBuku->id]) : route('store') }}">
                    @csrf
                    @if (isset($detailBuku))
                        @method('put')
                    @endif
                    {{-- Judul Buku --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul"
                            value="{{ old('judul', $detailBuku->judul ?? '') }}">
                        @error('judul')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>

                        <select class="form-select" name="kategori_id">
                            @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $detailBuku->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- ISBN --}}
                    <div class="mb-3">
                        <label class="form-label"> ISBN</label>
                        <input type="text" class="form-control" name="isbn"
                            value="{{ old('isbn', $detailBuku->isbn ?? '') }}">
                        @error('isbn')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Penulis --}}
                    <div class="mb-3">
                        <label class="form-label">Penulis Buku</label>
                        <input type="text" class="form-control" name="penulis"
                            value="{{ old('penulis', $detailBuku->penulis ?? '') }}">
                        @error('penulis')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tahun Terbit --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="text" class="form-control" name="tahun_terbit"
                            value="{{ old('tahun_terbit', $detailBuku->tahun_terbit ?? '') }}">
                        @error('tahun_terbit')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Harga Satuan --}}
                    <div class="mb-3">
                        <label class="form-label">Harga Satuan</label>
                        <input type="text" class="form-control" name="harga"
                            value="{{ old('harga', $detailBuku->harga ?? '') }}">
                        @error('harga')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
