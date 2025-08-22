<?php
namespace App\Http\Controllers\Checkout;

use Webkul\Checkout\Http\Controllers\CartShippingRateController as BaseController;
use App\Services\RajaOngkirService;

class CartShippingRateController extends BaseController
{
    public function calculateShipping()
    {
        // Logika RajaOngkir di sini
    }
}