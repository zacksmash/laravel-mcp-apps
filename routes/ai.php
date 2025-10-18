<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::oauthRoutes();

Mcp::web('/mcp', \App\Mcp\Servers\PerformanceServer::class)
    ->when(! app()->environment('local'), function ($route) {
        $route->middleware('auth:api');
    });
