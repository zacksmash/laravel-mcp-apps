<?php

namespace App\Mcp\Methods;

use Illuminate\Support\Collection;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Methods\CallTool as McpCallTool;
use Laravel\Mcp\Server\Tool;

/**
 * @todo Remove when laravel support structured content & security schemes in MCP servers
 */
class CallTool extends McpCallTool
{
    /**
     * @return callable(Collection<int, Response>): array{content: array<int, array<string, mixed>>, isError: bool}
     */
    protected function serializable(Tool $tool): callable
    {
        return fn (ResponseFactory $factory): array => $factory->mergeMeta([
            ...parent::serializable($tool)($factory),
            'structuredContent' => $tool->structuredContent(),
        ]);
    }
}
