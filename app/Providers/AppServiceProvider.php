<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
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

        /**
         * @custom
         * This is a custom macro to provide meta information to the UI component
         * This may be deprecated in the future to more standardized approach.
         */
        \Laravel\Mcp\Response::macro('chatGPT', function (?string $view = null, ?callable $config = null) {
            $app = new \App\Mcp\Content\App(
                trim($view ?? view('mcp.app')->render())
            );

            return new static(
                $config ? $config($app) : $app
            );
        });
    }
}
