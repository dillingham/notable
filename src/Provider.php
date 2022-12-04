<?php

namespace Notable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Notable\Console\Install;
use Notable\Notable;

class Provider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('notable', function(){
            return new Notable;
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
            ]);
        }

        Route::macro('markdown', function($root = 'docs', $path = null) {
            return app('notable')->setup($root, $path);
        });
    }

    public function register()
    {
        //
    }
}
