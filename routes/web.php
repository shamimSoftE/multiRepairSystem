<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProblemSetupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TechnicianController;
use App\Models\ProblemSetup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


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
    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('view:clear');

    return view('auth.invendorLogin');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // account settings
    Route::get('/account_settings', [DashboardController::class, 'edit']);
    Route::post('/account_settings', [DashboardController::class, 'update']);

    // profile
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // supplier
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::post('/supplier_store', [SupplierController::class, 'store']);
    Route::get('/supplier_edit', [SupplierController::class, 'edit']);
    Route::post('/supplier_update', [SupplierController::class, 'update']);
    Route::post('/supplier_delete', [SupplierController::class, 'destroy']);

    // technician
    Route::get('technician', [TechnicianController::class, 'index']);
    Route::post('technician_store', [TechnicianController::class, 'store']);
    Route::get('technician_edit', [TechnicianController::class, 'edit']);
    Route::post('technician_update', [TechnicianController::class, 'update']);
    Route::post('technician_delete', [TechnicianController::class, 'destroy']);

    // problem setup
    Route::get('problemSetup', [ProblemSetupController::class, 'index']);
    Route::post('problemSetup_store', [ProblemSetupController::class, 'store']);
    Route::get('problemSetup_edit', [ProblemSetupController::class, 'edit']);
    Route::post('problemSetup_update', [ProblemSetupController::class, 'update']);
    Route::post('problemSetUp_delete', [ProblemSetupController::class, 'destroy']);

    // product
    Route::get('products', [ProductController::class, 'index']);
    Route::post('product_store', [ProductController::class, 'store']);
    Route::get('product_edit', [ProductController::class, 'edit']);
    Route::post('product_update', [ProductController::class, 'update']);
    Route::post('product_delete', [ProductController::class, 'destroy']);


});

require __DIR__.'/auth.php';
