<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //WARN: Because we force a schema, the site needs to have
        //      an https certificate. SO if you move the application
        //      make sure to get an SSL cert.
        //
       // if(!\App::environment('local'))
    //    {
            \URL::forceSchema('https');
     //   }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
