<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class StatsCardTemplate extends Resource
{
    const TEMPLATE = 'ui://apps/index.html';

    protected string $name = 'stats-card-template';

    protected string $title = 'Stats Card';

    protected string $mimeType = 'text/html+skybridge';

    protected string $uri = self::TEMPLATE;

    /**
     * The resource's description.
     */
    protected string $description = <<<'MARKDOWN'
        A simple stats card template built with Tailwind CSS and Blade.
    MARKDOWN;

    /**
     * Handle the resource request.
     */
    public function handle(): Response
    {
        return Response::text(view('mcp.index')->render());
    }
}
