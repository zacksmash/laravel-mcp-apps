<?php

namespace App\Mcp\Tools;

use App\Actions\WeatherData;
use App\Mcp\Core\Server\Tool;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
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

    public function __construct(public WeatherData $weatherData) {}

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $city = $request->get('city', 'San Francisco');

        return Response::text("Weather widget updated successfully for {$city}.");
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
     * Get the tool's structured content.
     *
     * @return array<string, mixed>
     */
    public function structuredContent(Request $request): array
    {
        return $this->weatherData->handle($request);
    }
}
