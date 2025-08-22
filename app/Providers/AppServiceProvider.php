<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Any registration logic
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Handle debugbar based on allowed IPs
        $allowedIPs = array_map('trim', explode(',', config('app.debug_allowed_ips')));
        $allowedIPs = array_filter($allowedIPs);

        if (!empty($allowedIPs)) {
            if (in_array(Request::ip(), $allowedIPs)) {
                // Do something when the IP is allowed
            }
        }
    }
}
