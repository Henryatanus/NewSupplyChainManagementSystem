<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FarmerDashboardController;
use App\Http\Controllers\WholesalerDashboardController;
use App\Http\Controllers\FactoryDashboardController;
use App\Http\Controllers\ChatController;
use App\Livewire\Chat;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chat/{receiverId}', Chat::class)->name('chat');
});

require __DIR__.'/auth.php';


//My Routes
Route::resource('coffee-beans', CoffeeBeanController::class);
Route::resource('inventories', InventoryController::class);
Route::resource('orders', OrderController::class);
Route::resource('supply-centers', SupplyCenterController::class);
Route::resource('vendor-applications', VendorApplicationController::class);


//Based on roles
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin']);

Route::get('/farmer/dashboard', [FarmerDashboardController::class, 'index'])
    ->middleware(['auth', 'role:farmer']);

Route::get('/wholesaler/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:wholesaler']);

Route::get('/factory/dashboard', [FarmerDashboardController::class, 'index'])
    ->middleware(['auth', 'role:factory']);

    

//Based on dashboard
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    
        Route::post('/admin/vendor/{id}/approve', [AdminDashboardController::class, 'approveVendor'])->name('admin.vendor.approve');
        Route::post('/admin/vendor/{id}/reject', [AdminDashboardController::class, 'rejectVendor'])->name('admin.vendor.reject');
    
    });
    
    Route::middleware(['auth', 'role:farmer'])->group(function () {
        Route::get('/farmer/dashboard', [FarmerDashboardController::class, 'index'])->name('dashboard.farmer');
    });
    
    Route::middleware(['auth', 'role:wholesaler'])->group(function () {
        Route::get('/wholesaler/dashboard', [WholesalerDashboardController::class, 'index'])->name('dashboard.wholesaler');
    });
    
    Route::middleware(['auth', 'role:factory'])->group(function () {
        Route::get('/factory/dashboard', [FactoryDashboardController::class, 'index'])->name('dashboard.factory');
    });

    //Chat Routes
    Route::get('/chat/{receiverId}', Chat::class)->name('chat');

    //Analytics Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    });

    //Vendor validation
    Route::post('/vendors/validate', [VendorController::class, 'validateCertificate'])->name('vendors.validate');
