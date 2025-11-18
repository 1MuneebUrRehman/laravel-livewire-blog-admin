<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
//        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
//        });
//
//        $this->routes(function () {
//            Route::middleware('api')
//                ->prefix('api')
//                ->group(base_path('routes/api.php'));
//
//            Route::middleware('web')
//                ->group(base_path('routes/web.php'));
//
//            // Add admin routes
//            Route::middleware('web')
//                ->prefix('admin')
//                ->name('admin.')
//                ->group(base_path('routes/admin.php'));
//        });
    }
}
