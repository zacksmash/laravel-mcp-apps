<?php

namespace App\Mcp\Methods;

use Illuminate\Support\Collection;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Methods\CallTool as McpCallTool;
use Laravel\Mcp\Server\Tool;

class CallTool extends McpCallTool
{
    /**
     * @override
     *
     * @return callable(Collection<int, Response>): array{content: array<int, array<string, mixed>>, isError: bool}
     */
    protected function serializable(Tool $tool): callable
    {
        return fn (Collection $responses): array => array_filter([
            '_meta' => method_exists($tool, 'toolMeta')
                ? $tool->toolMeta()
                : null,
            'structuredContent' => method_exists($tool, 'toolContent')
                ? $tool->toolContent()
                : null,
            'content' => $responses->map(fn (Response $response): array => $response->content()->toTool($tool))->all(),
            'isError' => $responses->contains(fn (Response $response): bool => $response->isError()),
        ], fn ($value): bool => filled($value));
    }
}
