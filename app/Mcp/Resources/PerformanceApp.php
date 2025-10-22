<?php

namespace App\Mcp\Resources;

use App\Enums\OpenAI;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class PerformanceApp extends Resource
{
    protected string $name = 'performance-app';

    protected string $title = 'Performance App';

    protected string $mimeType = OpenAI::MIME_TYPE->value;

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
        return Response::app(
            fn ($app) => $app
                ->prefersBorder()
                ->widgetDescription('A performance monitoring application.')
        );
    }

    public static function template()
    {
        return (new static)->uri();
    }
}
