<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AuthController;
 use App\Http\Controllers\ProductController;
 
 Route::get('/', function () {
     return view('auth.login');
 });
 
 // Rute untuk autentikasi
 Route::get('register', [AuthController::class, 'register'])->name('register');
 Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');
 
 Route::get('login', [AuthController::class, 'login'])->name('login');
 Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');
 Route::get('logout', [AuthController::class, 'logout'])->name('logout');
 
 // Rute yang memerlukan autentikasi
 Route::middleware(['auth'])->group(function () {
     // Dashboard
     Route::get('/dashboard', function () {
         return view('dashboard');
     })->name('dashboard');
 
     // Rute untuk produk
     Route::prefix('products')->group(function () {
         Route::get('', [ProductController::class, 'index'])->name('products');
         Route::get('create', [ProductController::class, 'create'])->name('products.create');
         Route::post('store', [ProductController::class, 'store'])->name('products.store');
         Route::get('show/{id}', [ProductController::class, 'show'])->name('products.show');
         Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
         Route::put('edit/{id}', [ProductController::class, 'update'])->name('products.update');
         Route::delete('t/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
     });
 
     // Profil pengguna
     Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
 });
 