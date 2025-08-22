<?php
namespace App\Http\Controllers\Shop;

use Webkul\Shop\Http\Controllers\CheckoutController as BaseCheckoutController;
use App\Services\RajaOngkirService; // Jika menggunakan Service

class CheckoutController extends BaseCheckoutController
{
    protected $rajaOngkir;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }

    // Tambahkan method untuk hitung ongkir
    public function getShippingRates()
    {
        $cart = $this->cart->getCart();
        $origin = 501; // Contoh: ID kota toko
        $destination = $cart->shipping_address->city_id;
        $weight = $cart->items->sum('weight');
        $courier = 'jne';

        $rates = $this->rajaOngkir->getShippingCost($origin, $destination, $weight, $courier);

        return response()->json($rates);
    }
}