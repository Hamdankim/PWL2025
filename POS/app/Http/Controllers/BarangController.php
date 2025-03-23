<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    // Menampilkan halaman utama barang
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list'  => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; // Set menu yang sedang aktif

        $kategori = KategoriModel::all(); // Ambil data kategori untuk filter kategori

        return view('barang.index', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'kategori'   => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengambil data barang dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'kategori_id')
            ->with('kategori');

        // Filter berdasarkan kategori_id jika ada
        if ($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
            ->addIndexColumn() // Menambahkan kolom index otomatis
            ->addColumn('aksi', function ($barang) {
                $btn  = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    // Menampilkan halaman form tambah barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list'  => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $kategori = KategoriModel::all(); // Ambil data kategori untuk ditampilkan di form
        $activeMenu = 'barang'; // Set menu yang sedang aktif

        return view('barang.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'kategori'   => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode'  => 'required|string|min:3|unique:m_barang,barang_kode', // Barang kode harus diisi, minimal 3 karakter, dan unik
            'barang_nama'  => 'required|string|max:100', // Nama barang harus diisi, berupa string, maksimal 100 karakter
            'harga_beli'   => 'required|numeric|min:0', // Harga beli harus diisi, berupa angka, dan minimal 0
            'harga_jual'   => 'required|numeric|min:0|gte:harga_beli', // Harga jual harus diisi, berupa angka, minimal 0, dan harus lebih besar atau sama dengan harga beli
            'kategori_id'  => 'required|integer|exists:m_kategori,kategori_id' // Kategori ID harus diisi, berupa angka, dan harus ada di tabel kategori
        ]);

        BarangModel::create([
            'barang_kode'  => $request->barang_kode,
            'barang_nama'  => $request->barang_nama,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
            'kategori_id'  => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    // Menampilkan detail barang
    public function show(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list'  => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang'; // Set menu yang sedang aktif

        return view('barang.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'barang'     => $barang,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit barang
    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list'  => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang'; // Set menu yang sedang aktif

        return view('barang.edit', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'barang'     => $barang,
            'kategori'   => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode'  => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id', // Barang kode harus diisi, minimal 3 karakter, dan unik kecuali untuk barang dengan id yang sedang diedit
            'barang_nama'  => 'required|string|max:100', // Nama barang harus diisi, berupa string, maksimal 100 karakter
            'harga_beli'   => 'required|numeric|min:0', // Harga beli harus diisi, berupa angka, dan minimal 0
            'harga_jual'   => 'required|numeric|min:0|gte:harga_beli', // Harga jual harus diisi, berupa angka, minimal 0, dan harus lebih besar atau sama dengan harga beli
            'kategori_id'  => 'required|integer|exists:m_kategori,kategori_id' // Kategori ID harus diisi, berupa angka, dan harus ada di tabel kategori
        ]);

        // Temukan barang berdasarkan ID
        $barang = BarangModel::findOrFail($id);

        // Update data barang
        $barang->update([
            'barang_kode'  => $request->barang_kode,
            'barang_nama'  => $request->barang_nama,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
            'kategori_id'  => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    // Menghapus barang
    public function destroy(string $id)
    {
        // Mengecek apakah data barang dengan ID yang dimaksud ada atau tidak
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            // Hapus data barang
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error saat menghapus, redirect dengan pesan error
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // Fungsi AJAX untuk menampilkan form tambah barang
    public function create_ajax()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get(); // Ambil data kategori untuk ditampilkan di form
        return view('barang.create_ajax')
            ->with('kategori', $kategori);
    }

    // Fungsi AJAX untuk menyimpan barang baru
    public function store_ajax(Request $request)
    {
        // Cek apakah request berupa AJAX atau JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi data input
            $rules = [
                'barang_kode'  => 'required|string|min:3|unique:m_barang,barang_kode', // Barang kode harus diisi, minimal 3 karakter, dan unik
                'barang_nama'  => 'required|string|max:100', // Nama barang harus diisi, berupa string, maksimal 100 karakter
                'harga_beli'   => 'required|numeric|min:0', // Harga beli harus diisi, berupa angka, dan minimal 0
                'harga_jual'   => 'required|numeric|min:0|gte:harga_beli', // Harga jual harus diisi, berupa angka, minimal 0, dan harus lebih besar atau sama dengan harga beli
                'kategori_id'  => 'required|integer|exists:m_kategori,kategori_id' // Kategori ID harus diisi, berupa angka, dan harus ada di tabel kategori
            ];

            // Validasi input
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal, kirim respon JSON dengan error
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false, // false menunjukkan validasi gagal
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // Pesan error validasi
                ]);
            }

            // Simpan data ke database
            BarangModel::create($request->all());

            // Kirim respon sukses
            return response()->json([
                'status'  => true,
                'message' => 'Data barang berhasil disimpan',
            ]);
        }

        // Redirect ke halaman utama jika bukan request AJAX
        return redirect('/');
    }

    // Fungsi AJAX untuk menampilkan form edit barang
    public function edit_ajax(string $id)
    {
        // Ambil data barang berdasarkan ID
        $barang = BarangModel::find($id);

        // Ambil daftar kategori (id dan nama)
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();

        // Kirim data ke view edit_ajax
        return view('barang.edit_ajax', [
            'barang'  => $barang,
            'kategori' => $kategori,
        ]);
    }

    // Fungsi AJAX untuk menyimpan perubahan data barang
    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi
            $rules = [
                'barang_kode'  => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id', // Barang kode harus diisi, minimal 3 karakter, dan unik kecuali untuk barang dengan id yang sedang diedit
                'barang_nama'  => 'required|string|max:100', // Nama barang harus diisi, berupa string, maksimal 100 karakter
                'harga_beli'   => 'required|numeric|min:0', // Harga beli harus diisi, berupa angka, dan minimal 0
                'harga_jual'   => 'required|numeric|min:0|gte:harga_beli', // Harga jual harus diisi, berupa angka, minimal 0, dan harus lebih besar atau sama dengan harga beli
                'kategori_id'  => 'required|integer|exists:m_kategori,kategori_id' // Kategori ID harus diisi, berupa angka, dan harus ada di tabel kategori
            ];

            // Validasi request
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal, kirim respon JSON
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false, // Respon JSON: true = berhasil, false = gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors(), // Menunjukkan field yang error
                ]);
            }

            // Cari barang berdasarkan ID
            $barang = BarangModel::find($id);

            if ($barang) {
                // Update data barang
                $barang->update($request->all());

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    // Fungsi AJAX untuk menampilkan konfirmasi hapus barang
    public function confirm_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    // Fungsi AJAX untuk menghapus barang
    public function delete_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Cari barang berdasarkan ID
            $barang = BarangModel::find($id);

            if ($barang) {
                // Hapus data barang
                $barang->delete();

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        return redirect('/');
    }
}