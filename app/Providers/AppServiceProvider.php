<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // 关键代码：在生产环境中强制所有静态资源和路由走 https://
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
