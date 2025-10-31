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
                'current' => $this->randomTemp(),
                'high' => $this->randomTemp(),
                'low' => $this->randomTemp(),
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

    public function randomTemp(): array
    {
        $c = rand(15, 40);
        $f = round($c * 9 / 5 + 32);

        return [
            'c' => $c,
            'f' => $f,
        ];
    }
}
