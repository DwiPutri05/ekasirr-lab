<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        } elseif (auth()->user()->role === 'kasir') {
            return redirect('/kasir');
        }
        return redirect('/login'); // fallback
    })->name('dashboard');

    Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');

    Route::get('/kasir', [TransactionController::class, 'index'])->middleware('kasir')->name('kasir.dashboard');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->middleware('kasir')->name('checkout');
    Route::get('/struk/{id}', [TransactionController::class, 'printReceipt'])->middleware('kasir')->name('transactions.struk');

    Route::get('/riwayat', [TransactionController::class, 'history'])->middleware('kasir')->name('transactions.history');
    Route::get('/riwayat/{id}', [TransactionController::class, 'detail'])->middleware('kasir')->name('transactions.detail');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::middleware('admin')->group(function () {
        Route::resource('products', ProductController::class)->except(['index', 'show']);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export');
    });

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
