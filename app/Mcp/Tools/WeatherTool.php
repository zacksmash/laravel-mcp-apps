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
        $this->structuredContent($this->getContent($request));

        $this->meta(['route' => 'weather']);

        $city = $request->get('city');

        return Response::text("Here is the current weather information you requested for {$city}.");
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

    /**
     * @custom
     * This is a custom method to provide content to hydrate the UI component
     * This may be deprecated in the future to more standardized approach.
     */
    public function structuredContent(?array $data = null): array
    {
        if (empty($data)) {
            return $this->structured_content;
        }

        return $this->structured_content = $data;
    }

    /**
     * @custom
     * This is a custom method to provide meta information to the UI component
     * This may be deprecated in the future to more standardized approach.
     */
    public function meta(?array $meta = null): array
    {
        if (empty($meta)) {
            return $this->meta;
        }

        return $this->meta = $meta;
    }

    /**
     * @override
     * Get the tool's array representation.
     */
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            '_meta' => [ // This is the Tool Response meta
                OpenAI::OUTPUT_TEMPLATE->value => WeatherAppResource::template(),
                OpenAI::WIDGET_ACCESSIBLE->value => true,
                OpenAI::TOOL_INVOKING->value => 'Working on it...',
                OpenAI::TOOL_INVOKED->value => 'Example Tool Completed',
            ],
        ];
    }
}
