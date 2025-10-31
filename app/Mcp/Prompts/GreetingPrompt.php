<?php

namespace App\Mcp\Prompts;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Prompt;
use Laravel\Mcp\Server\Prompts\Argument;

class GreetingPrompt extends Prompt
{
    /**
     * The prompt's description.
     */
    protected string $description = <<<'MARKDOWN'
    A friendly greeting prompt that personalizes the message based on user input.
    MARKDOWN;

    /**
     * Handle the prompt request.
     */
    public function handle(Request $request): Response
    {
        $request->validate([
            'name' => 'required|string',
            'sentiment' => 'required|string',
        ]);

        return Response::text("Hello {$request->get('name')}! It's great to see you feeling {$request->get('sentiment')} today.");
    }

    /**
     * Get the prompt's arguments.
     *
     * @return array<int, \Laravel\Mcp\Server\Prompts\Argument>
     */
    public function arguments(): array
    {
        return [
            new Argument(
                name: 'name',
                description: 'The name of the user to greet.',
                required: true,
            ),
            new Argument(
                name: 'sentiment',
                description: 'The sentiment of the greeting.',
                required: true,
            ),
        ];
    }
}
