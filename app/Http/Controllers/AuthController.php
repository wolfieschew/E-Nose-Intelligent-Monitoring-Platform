<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.register');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input login
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cek apakah user aktif
        $user = User::where('user_name', $request->username)->first();

        if ($user && $user->status !== 'active') {
            return redirect()->route('show.login')->withErrors([
                'login_error' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
            ])->withInput($request->only('username'));
        }

        // Melakukan autentikasi dengan kolom user_name
        if (Auth::attempt(['user_name' => $request->username, 'password' => $request->password], $request->filled('remember'))) {

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Mendapatkan user yang sedang login
            $user = Auth::user();

            // Menyimpan data pengguna dalam session
            session([
                'user_name' => $user->user_name,
                'user_group' => $user->user_group,
                'login_time' => now(),
            ]);

            // Redirect berdasarkan role
            $redirectRoute = $user->user_group === 'admin' ? 'admin-enose-dashboard' : 'dashboard';

            return redirect()->intended(route($redirectRoute))->with('success', 'Selamat datang, ' . $user->user_name . '!');
        } else {
            // Jika login gagal
            return redirect()->route('show.login')->withErrors([
                'login_error' => 'Username atau password salah.',
            ])->withInput($request->only('username'));
        }
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input registrasi
        $validated = $request->validate([
            'username' => 'required|string|min:3|max:50|unique:user,user_name',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        try {
            // Membuat pengguna baru
            $user = new User();
            $user->user_name = $request->username;
            $user->password = Hash::make($request->password);
            $user->user_group = 'user'; // Default role user
            $user->status = 'active'; // Default status aktif
            $user->save();

            // Kirim notifikasi sukses dan arahkan ke halaman login
            return redirect()->route('show.user-management')->with('success', 'Akun berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()->route('show.register')->withErrors([
                'register_error' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.',
            ])->withInput($request->except('password', 'password_confirmation'));
        }
    }

    // Menangani logout
    public function logout(Request $request)
    {
        // Hapus session data
        $request->session()->forget(['user_name', 'user_group', 'login_time']);

        // Logout dari Auth
        Auth::logout();

        // Invalidate session untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login')->with('success', 'Anda berhasil logout.');
    }
}
