<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::oauthRoutes();

Mcp::web('/mcp', \App\Mcp\Servers\PerformanceServer::class)
    ->when(! app()->isLocal(),
        fn ($route) => $route->middleware('auth:api')
    );
