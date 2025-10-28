<?php

namespace App\Mcp\Tools;

use App\Actions\WeatherData;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly()]
class UpdateWeatherTool extends Tool
{
    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
    Update the weather widget with the latest weather information.
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request, WeatherData $weatherData): Response
    {
        return Response::text('Weather widget updated successfully.')
            ->structuredContent($weatherData->handle($request));
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'city' => $schema->string()->description('The city to get the weather for.'),
        ];
    }
}
