<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::oauthRoutes();

Mcp::web('/mcp', \App\Mcp\Servers\StatsCardServer::class)
    ->middleware(app()->environment('local') ? null : 'auth:api');
