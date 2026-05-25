@extends('layouts.template')

@section('content')
<div class="container mt-3">

    <h1 class="mb-3">Halaman Buku</h1>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">

            <a href="{{ route('form-create') }}" class="btn btn-primary btn-sm">
                + Tambah Data
            </a>

            <form class="d-flex" method="GET">
                <input 
                    name="keyword" 
                    type="text" 
                    class="form-control form-control-sm me-2"
                    placeholder="Cari judul / penulis / ISBN"
                >
                <button class="btn btn-success btn-sm" type="submit">
                    Cari
                </button>
            </form>

        </div>

        
        <div class="table-responsive">

            <table class="table table-hover table-striped table-bordered align-middle text-nowrap">

                <thead class="table-grey">
                    <tr class="text-center">
                        <th width="50">No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>ISBN</th>
                        <th>Kategori</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dataBuku as $index => $item)
                        <tr>

                            <td class="text-center">
                                {{ $dataBuku->firstItem() + $index }}
                            </td>

                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penulis }}</td>
                            <td class="text-center">{{ $item->tahun_terbit }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                          
                            <td class="text-nowrap">
                                {{ $item->detail->isbn ?? '-' }}
                            </td>

                            <td>
                                <span class="text-dark">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">

                                <a href="{{ route('detail-buku', $item->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Detail
                                </a>

                                <a href="{{ route('edit-buku', $item->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <!-- Trigger Modal -->
                                <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $item->id }}">
                                    Hapus
                                </button>

                            </td>

                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('delete-buku', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Data Buku</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Yakin ingin menghapus buku:
                                            <strong>{{ $item->judul }}</strong> ?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-danger py-3">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="p-3">
            {{ $dataBuku->links() }}
        </div>

    </div>
</div>
@endsection