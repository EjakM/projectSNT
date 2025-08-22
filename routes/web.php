<?php

use App\Http\Controllers\RajaOngkirController;

// Route untuk mendapatkan daftar provinsi
Route::get('/rajaongkir/provinces', [RajaOngkirController::class, 'getProvinces'])->name('rajaongkir.provinces');

// Route untuk mendapatkan daftar kota
Route::get('/rajaongkir/cities', [RajaOngkirController::class, 'getCities'])->name('rajaongkir.cities');

// Route untuk menghitung ongkos kirim
Route::post('/rajaongkir/ongkir', [RajaOngkirController::class, 'calculateOngkir'])->name('rajaongkir.ongkir');
