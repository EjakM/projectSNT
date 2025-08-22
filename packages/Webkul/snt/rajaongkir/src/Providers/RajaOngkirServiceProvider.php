<?php

namespace Webkul\snt\rajaongkir\Providers;


use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    public function register()
    {
        // You can bind classes here if needed
    }
}
