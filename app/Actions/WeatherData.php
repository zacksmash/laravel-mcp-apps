<?php

namespace App\Actions;

use Laravel\Mcp\Request;

class WeatherData
{
    public function handle(Request $request): array
    {
        return [
            'city' => $request->get('city', 'San Francisco'),
            'date' => now()->format('l M jS, Y'),
            'temp' => [
                'current' => [
                    'c' => 25,
                    'f' => 77,
                ],
                'high' => [
                    'c' => 26,
                    'f' => 79,
                ],
                'low' => [
                    'c' => 19,
                    'f' => 66,
                ],
            ],
            'conditions' => [
                [
                    'label' => 'Wind Dir.',
                    'value' => 'N/A',
                ],
                [
                    'label' => 'Humidity',
                    'value' => '420%',
                ],
                [
                    'label' => 'Precip.',
                    'value' => '55%',
                ],
            ],
        ];
    }
}
