<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
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
        Passport::authorizationView(
            fn ($parameters) => Inertia::render('auth/OAuthAuthorize', [
                'request' => $parameters['request'],
                'authToken' => $parameters['authToken'],
                'client' => $parameters['client'],
                'user' => $parameters['user'],
                'scopes' => $parameters['scopes'],
            ])
        );

        Passport::tokensCan([
            'mcp:use' => 'Use the Weather MCP',
        ]);

        Response::macro('app', function (?callable $callback = null, ?string $view = null) {
            $app = new \App\Mcp\Content\App(
                $view ?? view('mcp.app')->render()
            );

            return new static(
                $callback ? $callback($app) : $app
            );
        });
    }
}
