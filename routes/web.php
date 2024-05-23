<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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


});
