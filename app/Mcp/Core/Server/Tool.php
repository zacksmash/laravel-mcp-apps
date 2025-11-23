<?php

namespace App\Mcp\Core\Server;

use App\Mcp\Support\SecuritySchemes;
use Laravel\Mcp\Request;
use Laravel\Mcp\Server\Tool as McpTool;

/**
 * @todo Remove when laravel mcp supports structured content & security schemes
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
        return ! empty($this->structured_content) ? $this->structured_content : [];
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
     *
     * @see \Laravel\Mcp\Server\Tool::toArray()
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
