<?php

namespace App\Mcp\Resources;

use App\Enums\OpenAI;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class WeatherAppResource extends Resource
{
    protected string $name = 'weather-app';

    protected string $title = 'Weather App';

    protected string $mimeType = OpenAI::MIME_TYPE->value;

    protected string $uri = 'ui://apps/weather';

    /**
     * The resource's description.
     */
    protected string $description = <<<'MARKDOWN'
        A simple weather MCP UI template.
    MARKDOWN;

    /**
     * Handle the resource request.
     */
    public function handle(): Response|array
    {
        return Response::app();
    }

    public static function template()
    {
        return (new static)->uri();
    }
}
