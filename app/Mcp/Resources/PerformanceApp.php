<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class PerformanceApp extends Resource
{
    const TEMPLATE = 'ui://apps/performance.html';

    protected string $name = 'performance-app';

    protected string $title = 'Performance App';

    protected string $mimeType = 'text/html+skybridge';

    protected string $uri = self::TEMPLATE;

    /**
     * The resource's description.
     */
    protected string $description = <<<'MARKDOWN'
        A simple performance app template built with Tailwind CSS and Blade.
    MARKDOWN;

    /**
     * Handle the resource request.
     */
    public function handle(): Response
    {
        return Response::text(view('mcp.index')->render());
    }
}
