<?php

namespace App\Mcp\Tools;

use App\Mcp\Resources\PerformanceApp;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly()]
class GetPerformanceTool extends Tool
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

    public function meta(): array
    {
        return [
            'route' => 'about',
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

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            '_meta' => [
                'openai/outputTemplate' => PerformanceApp::TEMPLATE,
                'openai/toolInvocation/invoking' => 'Collecting data from platforms...',
                // 'openai/toolInvocation/invoked' => 'Displayed the performance app',
                'openai/widgetAccessible' => true,
                'openai/widgetPrefersBorder' => true,
            ],
        ];
    }
}
