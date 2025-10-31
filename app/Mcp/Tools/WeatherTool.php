<?php

namespace App\Mcp\Tools;

use App\Actions\WeatherData;
use App\Mcp\Resources\WeatherAppResource;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Enums\OpenAI;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;
use Laravel\Mcp\Support\SecurityScheme;
use Laravel\Passport\Passport;

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
        $request->validate([
            'city' => 'required',
        ]);

        $city = $request->get('city', 'San Francisco');

        $content = $weatherData->handle($request);

        return [
            // Response::resource([
            //     'uri' => 'ui://base/list-widget',
            //     'mimeType' => 'text/uri-list',
            //     'text' => route('mcp-ui', [
            //         'city' => $city,
            //     ]),
            // ]),
            Response::json($content),
            Response::text("Here is the current weather information you requested for {$city}.")
                ->meta(['route' => 'weather'])
                ->structuredContent($content),
        ];
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'city' => $schema->string()->description('The city to get the weather for.')->required(),
            'items' => $schema->array()->items(
                $schema->string()->enum(['temperature', 'humidity', 'wind', 'forecast'])
            )->description('The weather items to retrieve.')->default(['temperature', 'humidity']),
            'units' => $schema->number()->description('The units for temperature (e.g., Celsius or Fahrenheit).')->default(5),
            'integer' => $schema->integer()->description('The number of days for the forecast.')->default(3),
            'detailed' => $schema->boolean()->description('Whether to include detailed weather information.')->default(false),
            'object' => $schema->object(fn () => [
                'includeHumidity' => $schema->boolean()->description('Whether to include humidity information.')->default(true),
                'includeWind' => $schema->boolean()->description('Whether to include wind information.')->default(true),
            ])->description('Additional options for the weather data.'),
        ];
    }

    /**
     * Set the tool's security scheme policies
     */
    public function securitySchemes(SecurityScheme $scheme): array
    {
        return [
            $scheme->oauth2(Passport::scopeIds()),
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
