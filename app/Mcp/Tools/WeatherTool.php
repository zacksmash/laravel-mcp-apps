<?php

namespace App\Mcp\Tools;

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
    protected $structured_content;

    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
    This tool provides current weather data and forecasts
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response|array
    {
        $city = $request->get('city');

        $this->getContent($request);

        return Response::text("Here is the current weather information you requested for {$city}.");
    }

    protected function getContent(Request $request): void
    {
        $this->structured_content = [
            'user' => auth()->user(),
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
     * @custom
     * This is a custom method to provide meta information for the UI.
     * This may be deprecated in the future in favor of a more standardized approach.
     */
    public function structuredContent(): ?array
    {
        return $this->structured_content;
    }

    /**
     * @custom
     * This is a custom method to provide meta information for the UI.
     * This may be deprecated in the future in favor of a more standardized approach.
     */
    public function meta()
    {
        return [
            'route' => 'weather',
        ];
    }

    /**
     * @override
     * Get the tool array representation.
     */
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            '_meta' => [
                OpenAI::OUTPUT_TEMPLATE->value => WeatherAppResource::template(),
                OpenAI::WIDGET_ACCESSIBLE->value => true,
                OpenAI::TOOL_INVOKING->value => 'Working on it...',
                OpenAI::TOOL_INVOKED->value => 'Example Tool Completed',
            ],
        ];
    }
}
