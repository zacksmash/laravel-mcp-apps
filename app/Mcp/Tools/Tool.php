<?php

namespace App\Mcp\Tools;

use App\Mcp\Support\SecuritySchemes;
use Laravel\Mcp\Server\Tool as McpTool;

/**
 * @extends McpTool<null>
 *
 * @see \Laravel\Mcp\Server\Tool
 *
 * @todo Remove when laravel support structured content & security schemes in MCP servers
 */
class Tool extends McpTool
{
    /**
     * @var array<string, mixed>|null
     */
    protected ?array $structured_content = null;

    /**
     * @param  array<string, mixed>|string  $meta
     */
    public function setStructuredContent(array|string $content, mixed $value = null): void
    {
        $this->structured_content ??= [];

        if (! is_array($content)) {
            if (is_null($value)) {
                throw new InvalidArgumentException('Value is required when using key-value signature.');
            }

            $this->structured_content[$content] = $value;

            return;
        }

        $this->structured_content = array_merge($this->structured_content, $content);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function structuredContent(): ?array
    {
        return $this->structured_content;
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
