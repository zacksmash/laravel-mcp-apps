<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::oauthRoutes();

Mcp::web('/mcp', \App\Mcp\Servers\WeatherServer::class)
    ->when(! app()->isLocal(),
        fn ($route) => $route->middleware('auth:api')
    );
