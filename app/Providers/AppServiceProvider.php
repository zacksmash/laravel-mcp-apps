<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Mcp\Response;
use Laravel\Passport\Passport;

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
        Passport::authorizationView(function ($parameters) {
            return view('mcp.authorize', $parameters);
        });

        Passport::tokensCan([
            'mcp:use' => 'Use the Weather MCP',
        ]);

        // Response::macro('app', function (string $text) {
        //     return new static(new \App\Mcp\Content\App($text));
        // });
    }
}
