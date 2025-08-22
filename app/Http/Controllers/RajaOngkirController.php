<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => "uiOaOjVB19674d2caa0b25cdzms2SCyF"
        ])->get("https://api.rajaongkir.com/starter/province");

        return response()->json($response->json());
    }

    public function getCities(Request $request)
    {
        $provinceId = $request->query('province_id');
        $response = Http::withHeaders([
            'key' => 'uiOaOjVB19674d2caa0b25cdzms2SCyF'
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $provinceId
        ]);

        return response()->json($response->json());
    }

    public function calculateOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => 'YOUR_RAJAONGKIR_API_KEY'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->input('origin'),
            'destination' => $request->input('destination'),
            'weight' => $request->input('weight'),
            'courier' => $request->input('courier')
        ]);

        return response()->json($response->json());
    }
}
