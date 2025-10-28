<?php

namespace App\Mcp\Tools;

use App\Actions\WeatherData;
use App\Enums\OpenAI;
use App\Mcp\Resources\WeatherAppResource;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly()]
class WeatherTool extends Tool
{
    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
    This tool provides current weather data and forecasts
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request, WeatherData $weatherData): Response|array
    {
        $city = $request->get('city');

        return Response::text("Here is the current weather information you requested for {$city}.")
            ->meta(['route' => 'weather'])
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

    /**
     * Get the tool's meta information.
     *
     * @return array<string, mixed>
     */
    public function meta(): array
    {
        return [
            OpenAI::OUTPUT_TEMPLATE->value => WeatherAppResource::TEMPLATE,
            OpenAI::WIDGET_ACCESSIBLE->value => true,
            OpenAI::TOOL_INVOKING->value => 'Working on it...',
            OpenAI::TOOL_INVOKED->value => 'Example Tool Completed',
        ];
    }
}
