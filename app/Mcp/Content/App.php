<?php

namespace App\Mcp\Content;

use Laravel\Mcp\Server\Contracts\Content;
use Laravel\Mcp\Server\Prompt;
use Laravel\Mcp\Server\Resource;
use Laravel\Mcp\Server\Tool;

class App implements Content
{
    protected array $meta = [];

    public function __construct(
        protected string $text,
    ) {
        //
    }

    /**
     * @return array<string, mixed>
     */
    public function toTool(Tool $tool): array
    {
        return $this->toArray();
    }

    /**
     * @return array<string, mixed>
     */
    public function toPrompt(Prompt $prompt): array
    {
        return $this->toArray();
    }

    public function meta(array $meta): self
    {
        $this->meta = array_merge($this->meta, $meta);

        return $this;
    }

    public function prefersBorder(bool $value = true): self
    {
        $this->meta['openai/widgetPrefersBorder'] = $value;

        return $this;
    }

    public function widgetDescription(string $value): self
    {
        $this->meta['openai/widgetDescription'] = $value;

        return $this;
    }

    public function widgetCSP(string $value): self
    {
        $this->meta['openai/widgetCSP'] = $value;

        return $this;
    }

    public function widgetDomain(string $value): self
    {
        $this->meta['openai/widgetDomain'] = $value;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function toResource(Resource $resource): array
    {
        return array_filter([
            'text' => $this->text,
            'uri' => $resource->uri(),
            'name' => $resource->name(),
            'title' => $resource->title(),
            'mimeType' => $resource->mimeType(),
            '_meta' => $this->meta ?? null,
        ], fn ($value) => filled($value));
    }

    public function __toString(): string
    {
        return $this->text;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'type' => 'app',
            'text' => $this->text,
        ];
    }
}
