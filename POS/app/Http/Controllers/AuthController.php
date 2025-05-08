<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke halaman home
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function register()
    {
        // Jika sudah login, redirect ke halaman home
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function postregister(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|min:4|max:20|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|string|min:6',
                'level_id' => 'required|exists:m_level,level_id'
            ], [
                // Custom error messages
                'username.required' => 'Username harus diisi',
                'username.min' => 'Username minimal 4 karakter',
                'username.max' => 'Username maksimal 20 karakter',
                'username.unique' => 'Username sudah digunakan',
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama maksimal 100 karakter',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter',
                'level_id.required' => 'Level harus dipilih',
                'level_id.exists' => 'Level tidak valid'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                UserModel::create([
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'password' => Hash::make($request->password),
                    'level_id' => $request->level_id
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Registrasi berhasil, silakan login',
                    'redirect' => url('login')
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        return redirect('register');
    }
}
