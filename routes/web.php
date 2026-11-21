<?php

use App\Http\Controllers\RetiroPDF\RetiroPDF as RetiroPDF;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/stock', function () {
        return view('livewire.stock.stock-show');
    })->name('stock_show');

    Route::get('/dashboard/historial-stock', function () {
        return view('livewire.stock.stock-historial-show');
    })->name('stock_historial');

    Route::get('/dashboard/retiro-stock', function () {
        return view('livewire.retiro.retiro-show');
    })->name('retiro_stock');

    Route::get('/dashboard/ver-retiros', function () {
        return view('livewire.retiro.retiros-table-show');
    })->name('retiro_ver');

    Route::get('/dashboard/Artificios', function () {
        return view('livewire.artificios.artificios-layout');
    })->name('artificios');

    Route::get('/dashboard/coordinaciones', function () {
        return view('livewire.coordinaciones.coordinaciones-layouts-show');
    })->name('coordinacion');

    Route::get('/dashboard/register', function () {
        return view('auth.register');
    })->name('registrar');

    Route::get('/dashboard/usuario', function () {
        return view('livewire.users.user-show');
    })->name('usuario');

    /* EXPORTAR PDF DE RETIROS */
    Route::get('/dashboard/generate-pdf/{fecha_inicio}/{fecha_fin}', [App\Http\Controllers\PDFController::class, 'generatePDF'])->name('prueba');
    Route::get('/dashboard/ExportOnlyRetiro/{id}', [App\Http\Controllers\PDFController::class, 'generateOnlyRetiro'])->name('exportOnlyRetiro');
    Route::get('/dashboard/ExportAllRetiros', [App\Http\Controllers\PDFController::class, 'exportAllRetiros'])->name('exportAllRetiros');
    Route::get('/dashboard/exportRetiroWithNote/{id}', [RetiroPDF::class, 'pdf_with_nota'])->name('pdf_with_nota');


    /* EXPORTAR STOCK */
    Route::get('/dashboard/exportStock', [App\Http\Controllers\PDFController::class, 'exportStock'])->name('exportStock');
    Route::get('/dashboard/exportHistorialStock', [App\Http\Controllers\PDFController::class, 'exportHistorialStock'])->name('exportHistorialStock');
    Route::get('/dashboard/exportHistorialStockItem/{id}', [App\Http\Controllers\PDFController::class, 'exportHistorialStockItem'])->name('exportHistorialStockItem');
    Route::get('/dashboard/exportHistorialStockDate/{date}', [App\Http\Controllers\PDFController::class, 'exportHistorialStockDate'])->name('exportHistorialStockDate');
});
