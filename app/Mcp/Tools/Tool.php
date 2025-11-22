<?php

namespace App\Mcp\Tools;

use App\Mcp\Support\SecuritySchemes;
use Laravel\Mcp\Request;
use Laravel\Mcp\Server\Tool as McpTool;

/**
 * @todo Remove when laravel support structured content & security schemes in MCP servers
 *
 * @see \Laravel\Mcp\Server\Tool
 */
class Tool extends McpTool
{
    /**
     * @var array<string, mixed>|null
     */
    protected ?array $structured_content = null;

    /**
     * @return array<string, mixed>|null
     */
    public function structuredContent(Request $request): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    public function securitySchemes(SecuritySchemes $schemes): array
    {
        return [];
    }

    /**
     * Get the tool's array representation.
     */
    public function toArray(): array
    {
        return array_filter(array_merge(parent::toArray(), [
            'securitySchemes' => SecuritySchemes::make(
                $this->securitySchemes(...)
            ),
        ]), filled(...));
    }
}
