<?php

namespace App\Mcp\Tools;

use App\Mcp\Core\Server\Tool;
use App\Mcp\Enums\McpApp;
use App\Mcp\Resources\WeatherAppResource;
use App\Mcp\Support\SecuritySchemes;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly()]
class WeatherTool extends Tool
{
    protected ?array $meta = [
        McpApp::OPEN_AI_OUTPUT_TEMPLATE => WeatherAppResource::TEMPLATE,
        McpApp::OPEN_AI_WIDGET_ACCESSIBLE => true,
        McpApp::OPEN_AI_TOOL_INVOKING => 'Working on it...',
        McpApp::OPEN_AI_TOOL_INVOKED => 'Example Tool Completed',
        McpApp::OPEN_AI_RESULT_CAN_PRODUCE_WIDGET => true,
    ];

    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
    This tool provides current weather data and forecasts
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request)
    {
        $city = $request->get('city', 'San Francisco');

        return Response::make([
            Response::text("Here is the current weather information you requested for {$city}."),
        ])->withMeta('route', 'weather');
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
     * Get the tool's security schemes.
     *
     * @return array<string, array<string, mixed>>
     */
    public function securitySchemes(SecuritySchemes $scheme): array
    {
        return [
            $scheme->oauth2('mcp:use'),
        ];
    }

    /**
     * Get the tool's structured content.
     *
     * @return array<string, mixed>
     */
    public function structuredContent(Request $request): array
    {
        return $this->getContent($request);
    }

    /**
     * Get the content for the weather tool.
     */
    protected function getContent(Request $request): array
    {
        return [
            // 'user' => auth()->user(),
            'city' => $request->get('city', 'San Francisco'),
            'date' => now()->format('l M jS, Y'),
            'temp' => [
                'current' => [
                    'c' => 28,
                    'f' => 82,
                ],
                'high' => [
                    'c' => 26,
                    'f' => 78,
                ],
                'low' => [
                    'c' => 15,
                    'f' => 59,
                ],
            ],
            'conditions' => [
                [
                    'label' => 'Wind Dir.',
                    'value' => 'NE',
                ],
                [
                    'label' => 'Humidity',
                    'value' => '72%',
                ],
                [
                    'label' => 'Precip.',
                    'value' => '15%',
                ],
            ],
        ];
    }
}
