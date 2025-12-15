<?php

namespace App\Mcp\Core;

use App\Mcp\Core\Server\Methods\CallTool;

class Server extends Laravel\Mcp\Server
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
