<?php

namespace App\Mcp\Methods;

use Illuminate\Container\Container;
use Illuminate\Support\Collection;
use Laravel\Mcp\Request;
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
     * @return callable(Collection<int, Response>): array{
     *     content: array<int, array<string, mixed>>,
     *     isError: bool,
     *     structuredContent: array<string, mixed>
     * }
     */
    protected function serializable(Tool $tool): callable
    {
        /** @var Request|null $request */
        $request = Container::getInstance()->bound('mcp.request')
            ? Container::getInstance()->make('mcp.request')
            : null;

        return fn (ResponseFactory $factory): array => $factory->mergeMeta([
            ...parent::serializable($tool)($factory),
            ...array_filter([
                'structuredContent' => $request instanceof Request
                    ? $tool->structuredContent($request)
                    : null,
            ], filled(...)),
        ]);
    }
}
