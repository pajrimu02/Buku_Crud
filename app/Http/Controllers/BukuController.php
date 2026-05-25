<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index(Request $request)
    {
#Cara pertama
    // detial buku dari buku
    $detailBuku = Buku::find(1)->detail;
    // dd($buku->detail->isbn);

    // buku dari detail
    $detail = DetailBuku::find(3);
    // dd($detail->buku->judul);

#Cara kedua
    $buku = Buku::with('detail')->find(1);
    // dd($buku->detail->isbn ?? '-');


        $search = $request->keyword;

        $dataBuku = Buku::with(['detail','kategori'])
            ->when($search, function($query, $search){
            // Cari Judul
            return $query->where('judul', 'like', "%{$search}%")
            // Cari Penulis
            ->orWhere('penulis', 'like', "%{$search}%")
            // Cari Detial
            ->orWhereHas('detail', function($q2) use ($search) {
                $q2->where('isbn', 'like', "%{$search}%");
            })
            // Cari Kategori
            ->orWhereHas('kategori', function($q3) use ($search) {
                $q3->where('nama_kategori', 'like', "%{$search}%");
            })
            // Cari Tahun Terbit
            ->orWhere('tahun_terbit', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('pages.buku.daftar-buku', compact('dataBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $isbn = '-';
        return view('pages.buku.form-create', compact('kategori', 'isbn'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->judul);

        $validated = $request->validate(
            [
                'judul' => 'required|min:5',
                'penulis' => 'required|min:5',
                'tahun_terbit' => 'required|numeric',             
                'harga' => 'required|numeric',
                'isbn' => 'required|unique:detail_buku,isbn',
                'kategori_id' => 'required|exists:kategori,id',
            ],
            [
                'judul.required'=>'waduh judul bukunya jangan dikosongkan ya!',
                'judul.min'=>'judulnya terlalu pendek, minimal 3 karakter',
                'penulis.required'=>'setiap buku harus ada nama penulisnya!',
                'isbn.required' => 'ISBN harus diisi.',
                'isbn.unique' => 'ISBN sudah digunakan.',
                'kategori_id.required' => 'Kategori harus dipilih.',
                'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            ]
        );
        $validated['kategori_id'] = 1;

        Buku::create($validated);

        return redirect()->route('buku')->with('success', 'Buku baru berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //query db builder
        //$detailBuku = DB::table('buku')->where('id', $id)->firstOrFail();

        //orm
        // $detailBuku = Buku::find($id);
        $detailBuku = Buku::findOrFail($id);        

        return view('pages.buku.detail-buku', compact('detailBuku'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detailBuku = Buku::with('detail')->findOrFail($id);   
        $kategori = Kategori::all();
        return view('pages.buku.form-create', compact('detailBuku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'judul' => 'required|min:5',
                'penulis' => 'required|min:5',
                'harga' => 'required|numeric',
                'tahun_terbit' => 'required|numeric',             
            ],
            [
                'judul.required'=>'waduh judul bukunya jangan dikosongkan ya!',
                'judul.min'=>'judulnya terlalu pendek, minimal 3 karakter',
                'penulis.required'=>'setiap buku harus ada nama penulisnya!'
            ]
        );
        Buku::where('id', $id)->update($validated);
        return redirect()->route('buku')->with('success', 'Data buku berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detailBuku = Buku::findOrFail($id);        
        $detailBuku->delete();
        return redirect()->route('buku')->with('success', 'Data buku berhasil dihapus!');
        
    }
}
