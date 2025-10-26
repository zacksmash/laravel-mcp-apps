<?php

namespace App\Mcp\Resources;

use App\Enums\OpenAI;
use App\Mcp\Content\App;
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
    public function handle(): Response
    {
        /**
         * @custom
         * The app macro is defined in the AppServiceProvider to configure the UI
         * This may be deprecated in the future to more standardized approach.
         */
        return Response::app(
            config: fn (App $app) => $app->prefersBorder()
        );
    }

    /**
     * @custom
     * This is a custom method to provide the UI template name to any callers
     * This may be deprecated in the future to more standardized approach.
     */
    public static function template()
    {
        return (new static)->uri();
    }
}
