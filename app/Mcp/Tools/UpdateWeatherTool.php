<?php

namespace App\Mcp\Tools;

use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly()]
class UpdateWeatherTool extends Tool
{
    protected $structured_content;

    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
        Update the weather widget with the latest weather information.
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $this->getContent($request);

        return Response::text('Weather widget updated successfully.');
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

    public function getContent(Request $request): void
    {
        $this->structured_content = [
            'user' => auth()->user(),
            'city' => $request->get('city', 'Denver'),
            'date' => now()->format('l M jS, Y'),
            'temp' => [
                'current' => [
                    'c' => 25,
                    'f' => 77,
                ],
                'high' => [
                    'c' => 26,
                    'f' => 79,
                ],
                'low' => [
                    'c' => 19,
                    'f' => 66,
                ],
            ],
            'conditions' => [
                [
                    'label' => 'Wind Dir.',
                    'value' => 'N/A',
                ],
                [
                    'label' => 'Humidity',
                    'value' => '420%',
                ],
                [
                    'label' => 'Precip.',
                    'value' => '55%',
                ],
            ],
        ];
    }

    public function structuredContent(): ?array
    {
        return $this->structured_content;
    }
}
