<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $link_ads = Config::where('title', 'link_ads')->first();
        
        if(!$link_ads){
            Config::create([
                'title' => 'link_ads',
                'value' => env('APP_URL')
            ]);
        }
    }
}
