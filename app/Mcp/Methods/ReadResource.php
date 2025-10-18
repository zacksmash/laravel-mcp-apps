<?php

namespace App\Mcp\Methods;

use Illuminate\Support\Collection;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Methods\ReadResource as McpReadResource;
use Laravel\Mcp\Server\Resource;

class ReadResource extends McpReadResource
{
    protected function serializable(Resource $resource): callable
    {
        return fn (Collection $responses): array => [
            'contents' => $responses->map(fn (Response $response): array => array_filter(
                array_merge(
                    $response
                        ->content()
                        ->toResource($resource),
                    [
                        '_meta' => method_exists($resource, 'meta') ? $resource->meta() : null,
                    ],
                ),
                fn ($value) => $value !== null
            )
            )->all(),
        ];
    }
}
