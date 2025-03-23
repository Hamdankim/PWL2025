<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StokController extends Controller
{
    // Menampilkan halaman stok
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok stok dalam sistem'
        ];

        $activeMenu = 'stok';

        $suppliers = SupplierModel::all();
        $stok = StokModel::all();
        $user = UserModel::all();
        $barang = BarangModel::all();
        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'suppliers' => $suppliers,
            'stok' => $stok,
            'user' => $user,
            'barang' => $barang,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengambil data stok dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['supplier', 'barang', 'user']);

        // Filter berdasarkan supplier_id jika ada
        if ($request->supplier_id) {
            $stoks->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($stoks)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                $btn = '<button onclick="modalAction(\'' . url('stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok stok baru'
        ];

        $suppliers = SupplierModel::all();
        $stok = StokModel::all();
        $user = UserModel::all();
        $activeMenu = 'stok';

        return view('stok.create', compact('breadcrumb', 'page', 'suppliers', 'stok', 'user', 'activeMenu'));
    }

    // Menyimpan stok baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        StokModel::create($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Menampilkan detail stok
    public function show($id)
    {
        $stok = StokModel::with(['supplier', 'barang', 'user'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang'; // Set menu yang sedang aktif

        return view('stok.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit stok
    public function edit($id)
    {
        $stok = StokModel::findOrFail($id);
        $suppliers = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'suppliers', 'barang', 'user', 'activeMenu'));
    }

    // Menyimpan perubahan data stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
            'user_id' => 'required|exists:m_user,user_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        $stok = StokModel::findOrFail($id);
        $stok->update($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil diperbarui');
    }

    // Menghapus stok
    public function destroy($id)
    {
        $stok = StokModel::find($id);

        if (!$stok) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            $stok->delete();
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terkait dengan data lain');
        }
    }

    // Fungsi AJAX untuk menampilkan form tambah stok
    public function create_ajax()
    {
        try {
            $suppliers = SupplierModel::select('supplier_id', 'supplier_nama')->get();
            $barang = BarangModel::select('barang_id', 'barang_nama')->get();
            $users = UserModel::select('user_id', 'nama')->get();

            return view('stok.create_ajax', [
                'suppliers' => $suppliers,
                'barang' => $barang,
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi AJAX untuk menyimpan stok baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $rules = [
                    'supplier_id' => 'required|exists:m_supplier,supplier_id',
                    'barang_id' => 'required|exists:m_barang,barang_id',
                    'user_id' => 'required|exists:m_user,user_id',
                    'stok_tanggal' => 'required|date',
                    'stok_jumlah' => 'required|integer|min:1'
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validasi gagal',
                        'msgField' => $validator->errors()
                    ]);
                }

                StokModel::create($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil disimpan'
                ]);

            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
        }

        return redirect('/');
    }

    // Fungsi AJAX untuk menampilkan form edit stok
    public function edit_ajax(string $id)
    {
        try {
            // Debug log
            Log::info('Editing stok with ID: ' . $id);
            
            // Ambil data stok berdasarkan ID dengan relasi
            $stok = StokModel::find($id);
            
            if (!$stok) {
                Log::warning('Stok not found with ID: ' . $id);
                return response()->json([
                    'status' => false,
                    'message' => 'Data stok tidak ditemukan'
                ], 404);
            }

            // Ambil data untuk dropdown
            $suppliers = SupplierModel::select('supplier_id', 'supplier_nama')->get();
            $barang = BarangModel::select('barang_id', 'barang_nama')->get();
            $users = UserModel::select('user_id', 'nama')->get();

            // Debug log
            Log::info('Successfully retrieved data for stok edit form');

            return view('stok.edit_ajax', compact('stok', 'suppliers', 'barang', 'users'));

        } catch (\Exception $e) {
            Log::error('Error in edit_ajax: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi AJAX untuk menyimpan perubahan data stok
    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi
            $rules = [
                'supplier_id' => 'required|exists:m_supplier,supplier_id',
                'barang_id' => 'required|exists:m_barang,barang_id',
                'user_id' => 'required|exists:m_user,user_id',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer|min:1'
            ];

            // Validasi request
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal, kirim respon JSON
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon JSON: true = berhasil, false = gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(), // Menunjukkan field yang error
                ]);
            }

            // Cari stok berdasarkan ID
            $stok = StokModel::find($id);

            if ($stok) {
                // Update data stok
                $stok->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    // Fungsi AJAX untuk menampilkan konfirmasi hapus stok
    public function confirm_ajax(string $id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', ['stok' => $stok]);
    }

    // Fungsi AJAX untuk menghapus stok
    public function delete_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Cari stok berdasarkan ID
            $stok = StokModel::find($id);

            if ($stok) {
                // Hapus data stok
                $stok->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        return redirect('/');
    }
}