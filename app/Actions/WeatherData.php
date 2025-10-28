<?php

namespace App\Actions;

use Laravel\Mcp\Request;

class WeatherData
{
    public function handle(Request $request)
    {
        return [
            'user' => auth()->user(),
            'city' => $request->get('city', 'San Francisco'),
            'date' => now()->format('l M jS, Y'),
            'temp' => [
                'current' => [
                    'c' => 28,
                    'f' => 82,
                ],
                'high' => [
                    'c' => 26,
                    'f' => 78,
                ],
                'low' => [
                    'c' => 15,
                    'f' => 59,
                ],
            ],
            'conditions' => [
                [
                    'label' => 'Wind Dir.',
                    'value' => 'NE',
                ],
                [
                    'label' => 'Humidity',
                    'value' => '72%',
                ],
                [
                    'label' => 'Precip.',
                    'value' => '15%',
                ],
            ],
        ];
    }
}
