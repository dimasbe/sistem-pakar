<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showAdminLogin()
    {
        return view('auth.login', ['role' => 'admin']); // ← Update
    }

    /**
     * Show siswa login form
     */
    public function showSiswaLogin()
    {
        return view('auth.login', ['role' => 'siswa']); // ← Update
    }

    /**
     * Handle admin login
     */
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Handle siswa login
     */
    public function siswaLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::guard('siswa')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/siswa/dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Show admin register form
     */
    public function showAdminRegister()
    {
        return view('auth.admin.register');
    }

    /**
     * Show siswa register form
     */
    public function showSiswaRegister()
    {
        return view('auth.siswa.register');
    }

    /**
     * Handle admin registration
     */
    public function adminRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admin,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Handle siswa registration
     */
    public function siswaRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:siswa,email',
            'kelas' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Siswa::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('siswa.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Handle admin logout
     */
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')
            ->with('success', 'Logout berhasil!');
    }

    /**
     * Handle siswa logout
     */
    public function siswaLogout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/siswa/login')
            ->with('success', 'Logout berhasil!');
    }
}
