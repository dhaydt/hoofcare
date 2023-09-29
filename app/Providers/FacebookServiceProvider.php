<?php

namespace App\Providers;

use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(Facebook::class, function ($app){
            $config = config('services.facebook');
            return new Facebook([
                'app_app' => $config['clinet_id'],
                'app_secret' => $config['clinet_secret'],
                'default_graph_version' => 'v2.6'
            ]);
        });
    }
}
