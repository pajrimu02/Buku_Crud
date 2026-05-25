@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <h1>Halaman Buku</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('form-create') }}" class="btn btn-primary btn-sm">Tambah Data</a>

                <form class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm" width="250px">
                        <input name="keyword" type="text" class="form-control" placeholder="Cari data">
                        <button class="btn btn-sm btn-success" type="submit">Cari</button>
                    </div>
                </form>

            </div>
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">NO</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Harga</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Kategory</th>
                        <th scope="col" width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataBuku as $index => $item)
                        <tr>
                            <td scope="row" class="text-center">{{ $dataBuku->firstItem() + $index }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penulis }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->detail->isbn ?? '-' }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td class="text-ceter">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $item->id }}">
                                    Hapus
                                </button>

                                <a href="{{ route('edit-buku', ['id' => $item->id]) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil"></i>
                                    Edit</a>
                                <a href="{{ route('detail-buku', ['id' => $item->id]) }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-eye"></i>
                                    Detail</a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('delete-buku', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Buku</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Buku dengan judul <strong>{{ $item->judul }} akan dihapus</strong>, apakah
                                            anda
                                            yakin?

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Hapus Buku</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6">
                                <span class="text-danger">data yang anda cari tidak ada</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $dataBuku->links() }}
        </div>
    </div>
@endsection
