<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    // Menampilkan halaman stok
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list'  => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok barang dalam sistem'
        ];

        $activeMenu = 'stok';

        $suppliers = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu', 'suppliers', 'barang', 'user'));
    }

    // Mengambil data stok dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $stok = StokModel::with(['supplier', 'barang', 'user'])->select('t_stok.*');

        if ($request->supplier_id) {
            $stok->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>'
                    . '</form>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list'  => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok barang baru'
        ];

        $suppliers = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();
        $activeMenu = 'stok';

        return view('stok.create', compact('breadcrumb', 'page', 'suppliers', 'barang', 'user', 'activeMenu'));
    }

    // Menyimpan stok baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'  => 'required|exists:m_supplier,supplier_id',
            'barang_id'    => 'required|exists:m_barang,barang_id',
            'user_id'      => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah'  => 'required|integer|min:1'
        ]);

        StokModel::create($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Menampilkan detail stok
    public function show($id)
    {
        $stok = StokModel::with(['supplier', 'barang', 'user'])->findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list'  => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok barang'
        ];

        $activeMenu = 'stok';

        return view('stok.show', compact('breadcrumb', 'page', 'stok', 'activeMenu'));
    }

    // Menampilkan halaman edit stok
    public function edit($id)
    {
        $stok = StokModel::findOrFail($id);
        $suppliers = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list'  => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok barang'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'suppliers', 'barang', 'user', 'activeMenu'));
    }

    // Menyimpan perubahan data stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id'  => 'required|exists:m_supplier,supplier_id',
            'barang_id'    => 'required|exists:m_barang,barang_id',
            'user_id'      => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah'  => 'required|integer|min:1'
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
}
