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
        /**
         * @custom
         * This is a custom macro to provide meta information for the UI.
         * This may be deprecated in the future in favor of a more standardized approach.
         */
        return Response::app();
    }

    /**
     * @custom
     * This is a custom method to provide the template URI for the UI.
     * This may be deprecated in the future in favor of a more standardized approach.
     */
    public static function template()
    {
        return (new static)->uri();
    }
}
