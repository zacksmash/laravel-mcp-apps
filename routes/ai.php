<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::oauthRoutes();

Mcp::web('/mcp', \App\Mcp\Servers\WeatherServer::class)
    ->middleware('auth:api');
// ->when(! app()->isLocal(),
//     fn ($route) => $route->middleware('auth:api')
// );
