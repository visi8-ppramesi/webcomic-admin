<?php

namespace App\Providers;

use App\Services\ComicService;
use Illuminate\Support\Facades\Validator;
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
        $this->app->singleton(ComicService::class, function(){
            return new ComicService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_uri_or_url', function ($attribute, $value, $parameters, $validator) {
            return substr($value, 0, 5) == 'data:' || count(explode('/', $value)) > 1;
        });
    }
}
