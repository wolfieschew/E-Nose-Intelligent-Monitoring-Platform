<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetailModel;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function showProfile()
    {
        // Ambil user_name dari user yang sedang login
        $userName = Auth::user()->user_name;

        // Ambil detail user
        $user = UserDetailModel::where('user_name', $userName)->first();

        // Jika tidak ditemukan, redirect ke dashboard
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User tidak ditemukan.');
        }

        return view('profile', compact('user'));
    }

    // Update data profil
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $userName = Auth::user()->user_name;

        $user = UserDetailModel::where('user_name', $userName)->first();

        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User tidak ditemukan.');
        }

        // Update field
        $user->update([
            'user_name' => $request->user_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'description' => $request->description,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
