<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetailModel;
use App\Models\User;

class UserManagementController extends Controller
{
    public function userManagement()
    {
        $userDetail = UserDetailModel::all();
        $users = User::all();
        return view('pages.admin-user-management', [
            'data' => $userDetail,
            'users' => $users
        ]);
    }

    // Add user baru (user_name harus unik di user_detail dan user)
    public function addUser(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|unique:user_detail,user_name|unique:user,user_name',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Insert ke tabel user
        User::create([
            'user_name' => $validated['user_name'],
            'password' => bcrypt($validated['password']),
            'user_group' => 'user',
            'status' => 'active',
        ]);

        // Insert ke tabel user_detail (password tidak perlu di sini)
        UserDetailModel::create([
            'user_name' => $validated['user_name'],
            'address' => $validated['address'] ?? null,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('user-management')->with('success', 'User baru berhasil ditambahkan.');
    }

    // Update detail user yang sudah ada (user_name harus sudah ada di tabel user)
    public function updateUserDetail(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|exists:user,user_name',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        $detail = UserDetailModel::where('user_name', $validated['user_name'])->first();
        if ($detail) {
            $detail->update($validated);
        } else {
            UserDetailModel::create($validated);
        }
        return redirect()->route('user-management')->with('success', 'Detail user berhasil diupdate.');
    }

    public function deleteUser(Request $request)
    {
        UserDetailModel::where('user_name', $request->user_name)->delete();
        return redirect()->route('user-management')->with('success', 'User detail berhasil dihapus.');
    }
}
