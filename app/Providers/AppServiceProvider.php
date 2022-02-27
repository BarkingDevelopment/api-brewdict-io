<?php

namespace App\Providers;

use App\Http\Resources\Identifiers\ResourceIdentifier;
use App\Http\Resources\Objects\ResourceObject;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResourceIdentifier::withoutWrapping();
        ResourceObject::withoutWrapping();
    }
}
