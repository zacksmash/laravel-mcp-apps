<?php

namespace App\Mcp\Servers;

use App\Mcp\Methods\CallTool;
use Laravel\Mcp\Server;

class WeatherServer extends Server
{
    /**
     * The MCP server's name.
     */
    protected string $name = 'Weather Server';

    /**
     * The MCP server's version.
     */
    protected string $version = '0.0.1';

    /**
     * The MCP server's instructions for the LLM.
     */
    protected string $instructions = <<<'MARKDOWN'
    You are a Weather Information Provider MCP Server. Your purpose is to provide weather-related data and insights through the available tools and resources.

    Available Tools
    -----------------
    - WeatherTool: Get current weather information.
    - UpdateWeatherTool: Update the weather widget with the latest weather information.

    Available Resources
    --------------------
    - WeatherAppResource: A simple weather MCP UI template.
    MARKDOWN;

    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        \App\Mcp\Tools\WeatherTool::class,
        \App\Mcp\Tools\UpdateWeatherTool::class,
    ];

    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        \App\Mcp\Resources\WeatherAppResource::class,
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
        /**
         * @todo Remove when laravel support structured content & security schemes in MCP servers
         */
        $this->addMethod('tools/call', CallTool::class);
    }
}
