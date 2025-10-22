<?php

namespace App\Mcp\Tools;

use App\Enums\OpenAI;
use App\Mcp\Resources\PerformanceApp;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly()]
class PerformanceTool extends Tool
{
    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
        Get current platform performance statistics.
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response|array
    {
        return Response::text('Here are the current platform statistics');
    }

    public function structuredContent(): array
    {
        return [
            'stats' => [
                ['id' => 1, 'name' => 'Impressions', 'value' => '8,000+'],
                ['id' => 2, 'name' => 'CTR', 'value' => '3%'],
                ['id' => 3, 'name' => 'Unique Visitors', 'value' => '1,200+'],
                ['id' => 4, 'name' => 'Clicks', 'value' => '2,000+'],
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
        return [];
    }

    /**
     * @override Get the tool array representation.
     */
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            '_meta' => [
                OpenAI::OUTPUT_TEMPLATE->value => PerformanceApp::template(),
                OpenAI::WIDGET_ACCESSIBLE->value => true,
                OpenAI::TOOL_INVOKING->value => 'Collecting data from platforms...',
                OpenAI::TOOL_INVOKED->value => 'Displayed the performance app',
            ],
        ];
    }
}
