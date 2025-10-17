<?php

namespace App\Mcp\Servers;

use App\Mcp\Methods\CallTool;
use Laravel\Mcp\Server;

class PerformanceAppServer extends Server
{
    /**
     * The MCP server's name.
     */
    protected string $name = 'Performance App Server';

    /**
     * The MCP server's version.
     */
    protected string $version = '0.0.1';

    /**
     * The MCP server's instructions for the LLM.
     */
    protected string $instructions = <<<'MARKDOWN'
        You are a helpful assistant that provides a simple performance app template built with Tailwind CSS and Blade.
    MARKDOWN;

    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        \App\Mcp\Tools\GetPerformanceTool::class,
    ];

    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        \App\Mcp\Resources\PerformanceApp::class,
    ];

    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [
        //
    ];

    protected function boot(): void
    {
        $this->addMethod('tools/call', CallTool::class);
    }
}
