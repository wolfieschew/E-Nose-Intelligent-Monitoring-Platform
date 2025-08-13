<?php

// User Controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransactionEnoseController;
use App\Http\Controllers\TransactionEdgeController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;

// Admin Controller
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransactionEnoseController;
use App\Http\Controllers\AdminDeviceController;
use App\Http\Controllers\AdminTransactionEdgeController;
use App\Http\Controllers\UserMappingController;
use App\Http\Controllers\UserManagementController;

use Illuminate\Support\Facades\Route;

// Public routes (tidak perlu login)
Route::get('/', [AuthController::class, 'showLogin'])->name('index');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register-user', [AuthController::class, 'register'])->name('register');

// Static pages yang tidak perlu auth
Route::get('/create-account', function () {
    return view('pages.create-account');
})->name('create.account');
Route::get('/forgot-password', function () {
    return view('pages.forgot-password');
})->name('forgot.password');
Route::get('/404', function () {
    return view('pages.404');
})->name('not.found');

// Protected routes - memerlukan authentication
Route::middleware(['auth'])->group(function () {

    // Logout route (harus menggunakan POST untuk keamanan)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard routes
    Route::get('/dashboard', [TransactionEnoseController::class, 'dashboard'])->name('dashboard');

    // User routes - E-nose
    Route::get('/e-nose-dashboard', [TransactionEnoseController::class, 'dashboard'])->name('e-nose-dashboard');
    Route::get('/transaksi-enose', [TransactionEnoseController::class, 'index'])->name('transaksi-enose');

    Route::get('/download-row', [TransactionEnoseController::class, 'downloadRowCSV']);



    // sangat penting agar route menangkap string detik lengkap



    // User routes - Edge
    Route::get('/edge-dashboard', [TransactionEdgeController::class, 'dashboard'])->name('edge-dashboard');
    Route::get('/transaksi-edge', [TransactionEdgeController::class, 'index'])->name('transaksi-edge');

    // Device routes
    Route::get('/device', [DeviceController::class, 'device'])->name('device');

    // Profile routes
    Route::get('/profile', [UserProfileController::class, 'showProfile'])->name('profile');
    Route::post('edit-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');

    // Blank page
    Route::get('/blank', function () {
        return view('pages.blank');
    })->name('blank');
});

// Admin only routes - memerlukan authentication dan role admin
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin E-nose routes
    Route::get('/admin-enose-dashboard', [AdminTransactionEnoseController::class, 'adminDashboard'])->name('admin-enose-dashboard');
    Route::get('/admin-transaksi-enose', [AdminTransactionEnoseController::class, 'index'])->name('admin-transaksi-enose');
    Route::get('/admin-download-row', [AdminTransactionEnoseController::class, "admindownloadRowCSV"]);

    // Admin Edge routes
    Route::get('/admin-edge-dashboard', [AdminTransactionEdgeController::class, 'adminEdgeDashboard'])->name('admin-edge-dashboard');
    Route::get('/admin-transaksi-edge', [AdminTransactionEdgeController::class, 'index'])->name('admin-transaksi-edge');

    // Admin Device management
    Route::get('/admin-device', [AdminDeviceController::class, 'adminDevice'])->name('admin-device');
    Route::post('/add-device', [AdminDeviceController::class, 'addDevice'])->name('add-device');
    Route::post('/update-device', [AdminDeviceController::class, 'updateDevice'])->name('update-device');
    Route::delete('/delete-device', [AdminDeviceController::class, 'deleteDevice'])->name('delete-device');
    Route::post('/add-user-to-device', [AdminDeviceController::class, 'addUserToDevice'])->name('add-user-to-device');

    // User Management
    Route::get('/user-management', [UserManagementController::class, 'userManagement'])->name('user-management');
    Route::post('/add-user', [UserManagementController::class, 'addUser'])->name('add-user');
    Route::post('/update-user-detail', [UserManagementController::class, 'updateUserDetail'])->name('update-user-detail');
    Route::delete('/delete-user', [UserManagementController::class, 'deleteUser'])->name('delete-user');
});

// Redirect ke dashboard jika sudah login, atau ke login jika belum
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth');
