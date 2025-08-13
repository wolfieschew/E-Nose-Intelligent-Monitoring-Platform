<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceModel;
use App\Models\User;
use App\Models\UserMappingModel;

class AdminDeviceController extends Controller
{
    public function adminDevice()
    {
        $devices = DeviceModel::with('userMapping')->get();
        $users = User::all();
        return view('pages.admin-device', [
            'data' => $devices,
            'users' => $users
        ]);
    }

    public function addDevice(Request $request)
    {
        try {
            $validated = $request->validate([
                'device_id' => 'required|string|max:255|unique:device,device_id',
                'device_name' => 'required|string|max:255',
                'ip_address' => 'nullable',
                'mac_address' => 'nullable|string|max:255',
                'type' => 'required|string|in:e-nose,edge',
                'description' => 'nullable|string|max:500',
                //'user_name' => 'required|exists:user,username',
            ], [
                'device_id.unique' => 'Device ID sudah digunakan, silakan pilih Device ID lain.',
                'type.in' => 'Tipe perangkat harus berupa "enose" atau "edge".',
            ]);

            $device = DeviceModel::create([
                'device_id' => $validated['device_id'],
                'device_name' => $validated['device_name'],
                'ip_address' => $validated['ip_address'] ?? null,
                'mac_address' => $validated['mac_address'] ?? null,
                'type' => $validated['type'],
                'description' => $validated['description'] ?? null,
            ]);

            // Simpan mapping device-user ke tabel device_user_mapping
            // UserMappingModel::create([
            //     'device_id' => $validated['device_id'],
            //     'user_name' => $validated['user_name'],
            // ]);

            return redirect()->route('admin-device')->with('success', 'Device berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('admin-device')->with('error', $e->getMessage());
        }
    }

    public function updateDevice(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:device,device_id',
            'device_name' => 'required|string|max:255',
            'ip_address' => 'nullable|string|max:255',
            'mac_address' => 'nullable|string|max:255',
            'type' => 'required|string|in:e-nose,edge',
            'description' => 'nullable|string|max:500',
        ]);

        $device = DeviceModel::where('device_id', $validated['device_id'])->first();
        if ($device) {
            $device->update($validated);
        }

        // Update hak akses user (mapping user ke device)
        if ($request->has('user_name')) {
            // Hapus semua mapping lama
            UserMappingModel::where('device_id', $validated['device_id'])->delete();
            // Tambah mapping baru
            foreach ($request->user_names as $user_name) {
                UserMappingModel::create([
                    'device_id' => $validated['device_id'],
                    'user_name' => $user_name,
                ]);
            }
        }

        return redirect()->route('admin-device')->with('success', 'Device berhasil diupdate.');
    }

    public function deleteDevice(Request $request)
    {
        try {
            $request->validate([
                'device_id' => 'required|string|exists:device,device_id',
            ]);

            DeviceModel::where('device_id', $request->device_id)->delete();
            UserMappingModel::where('device_id', $request->device_id)->delete();

            return redirect()->route('admin-device')->with('success', 'Device berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin-device')->with('error', 'Terjadi kesalahan saat menghapus device.');
        }
    }

    public function addUserToDevice(Request $request)
{
        $validated = $request->validate([
            'device_id' => 'required|exists:device,device_id',
            'user_name' => 'required|exists:user,user_name',
        ]);

        // Cek apakah mapping sudah ada
        $exists = \App\Models\UserMappingModel::where('device_id', $validated['device_id'])
            ->where('user_name', $validated['user_name'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'User sudah terdaftar pada device ini.');
        }

        UserMappingModel::create([
            'device_id' => $validated['device_id'],
            'user_name' => $validated['user_name'],
        ]);

        return back()->with('success', 'User berhasil ditambahkan ke device.');
    }
}
