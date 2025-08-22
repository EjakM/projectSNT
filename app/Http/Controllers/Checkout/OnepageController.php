<?php

namespace App\Http\Controllers\Shop\Checkout;

use Webkul\Shop\Http\Controllers\OnepageController as BaseOnepageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;  // Pastikan Anda menggunakan ini

class OnepageController extends BaseOnepageController
{
    public function getShippingCost(Request $request)
{
    $response = Http::withHeaders([
        'key' => env('uiOaOjVB19674d2caa0b25cdzms2SCyF'),
    ])->post('https://api.rajaongkir.com/'.env('starter').'/cost', [
        'origin' => 501, // misalnya Surabaya
        'destination' => $request->destination, // kode kota tujuan
        'weight' => $request->weight, // dalam gram
        'courier' => $request->courier, // jne, tiki, pos, dll
    ]);

    $shippingData = $response->json();
    
    // Ambil ongkir dari response API
    $shippingCost = $shippingData['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'] ?? 0;

    return view('your-view-name', [
        'shippingCost' => $shippingCost,
        'cart' => $cart,  // pastikan variabel cart juga dikirimkan
    ]);
}
}