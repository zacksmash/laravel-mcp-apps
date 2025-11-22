<?php

namespace App\Mcp\Resources;

use App\Mcp\Enums\McpApp;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class WeatherAppResource extends Resource
{
    const TEMPLATE = 'ui://apps/weather';

    protected string $name = 'weather-app';

    protected string $title = 'Weather App';

    protected string $uri = self::TEMPLATE;

    protected string $mimeType = McpApp::OPEN_AI_MIME_TYPE;

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
        /**
         * @custom
         * The app macro is defined in AppServiceProvider to configure the UI options
         * This may be deprecated in the future to a more standardized approach.
         */
        return Response::text(view('mcp.app')->render())
            ->withMeta(McpApp::OPEN_AI_WIDGET_PREFERS_BORDER, true);
    }
}
