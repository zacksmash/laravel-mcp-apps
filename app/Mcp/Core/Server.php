<?php

namespace App\Mcp\Core;

use App\Mcp\Core\Server\Methods\CallTool;
use Laravel\Mcp\Server as McpServer;

class Server extends McpServer
{
    protected function boot(): void
    {
        /**
         * @todo Remove when laravel mcp supports structured content
         *
         * @see \Laravel\Mcp\Server\Methods\CallTool
         */
        $this->addMethod('tools/call', CallTool::class);
    }
}
