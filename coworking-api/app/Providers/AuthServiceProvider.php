<?php

namespace App\Providers;

use App\Models\Booking;
use App\Policies\BookingPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Booking::class => BookingPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
}
