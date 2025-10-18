<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class PerformanceApp extends Resource
{
    protected string $name = 'performance-app';

    protected string $title = 'Performance App';

    protected string $mimeType = 'text/html+skybridge';

    protected string $uri = 'ui://apps/performance';

    /**
     * The resource's description.
     */
    protected string $description = <<<'MARKDOWN'
        A simple performance app template built with Tailwind CSS and Blade.
    MARKDOWN;

    /**
     * Handle the resource request.
     */
    public function handle(): Response|array
    {
        return Response::app(meta: [
            // 'openai/widgetDescription' => '',
            'openai/widgetPrefersBorder' => true,
            // 'openai/widgetCSP' => '',
            // 'openai/widgetDomain' => '',
        ]);
    }

    public static function template()
    {
        return (new self)->uri;
    }
}
