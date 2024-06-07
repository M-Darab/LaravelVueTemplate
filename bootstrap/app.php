<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        web: __DIR__ . '/../routes/web.php',
        health: '/up',
        then: function () {

            // Admin Auth Routes
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ])->redirectGuestsTo(fn (Request $request) => match ($request->segment(1)) {
            'admin' => route('admin.login'),
            default => route('login'),
        })->redirectUsersTo(function () {
            foreach (array_keys(config('auth.guards')) as $guard) {
                if (auth($guard)->check()) {
                    return match ($guard) {
                        'admin' => route('admin.dashboard'),
                        'web' => route('dashboard'),
                    };
                }
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
