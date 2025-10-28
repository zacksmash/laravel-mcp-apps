<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Enums\OpenAI;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Content\App;
use Laravel\Mcp\Server\Resource;

class WeatherAppResource extends Resource
{
    const TEMPLATE = 'ui://apps/weather';

    protected string $name = 'weather-app';

    protected string $title = 'Weather App';

    protected string $uri = self::TEMPLATE;

    protected string $mimeType = OpenAI::MIME_TYPE->value;

    /**
     * The resource's description.
     */
    protected string $description = <<<'MARKDOWN'
    A simple weather MCP UI template.
    MARKDOWN;

    /**
     * Handle the resource request.
     */
    public function handle(): Response
    {
        return Response::app(view('mcp.app'),
            fn (App $app) => $app->prefersBorder()
        );
    }
}
