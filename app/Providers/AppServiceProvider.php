<?php

namespace App\Providers;

use App\Mcp\Content\Resource;
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
                'csrfToken' => csrf_token(),
            ])
        );

        Passport::tokensCan([
            'mcp:use' => 'Use the MCP Server API',
        ]);

        Response::macro('resource', function (array $data): static {
            return new static(new Resource($data));
        });
    }
}
