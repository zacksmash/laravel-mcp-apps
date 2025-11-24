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
                    'c' => 3,
                    'f' => 38,
                ],
                'high' => [
                    'c' => 7,
                    'f' => 44,
                ],
                'low' => [
                    'c' => -1,
                    'f' => 31,
                ],
            ],
            'conditions' => [
                [
                    'label' => 'Wind Dir.',
                    'value' => 'SW',
                ],
                [
                    'label' => 'Humidity',
                    'value' => '21%',
                ],
                [
                    'label' => 'Precip.',
                    'value' => '55%',
                ],
            ],
        ];
    }
}
