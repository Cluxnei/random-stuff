<?php

namespace App\Http\Controllers;

use Illuminate\Cache\Repository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    final public function index(): Renderable {
        $cards = [
            [
                'title' => 'Realtime Data',
                'description' => 'Realtime random data...',
                'route' => route('realtime.index'),
            ],
            [
                'title' => 'Numbers',
                'description' => 'Generate random number sequences...',
                'route' => route('numbers.index'),
            ],
            [
                'title' => 'Strings',
                'description' => 'Generate random string sequences...',
                'route' => route('strings.index'),
            ]
        ];
        return view('home', compact('cards'));
    }

    final public function numbers(): Renderable {
        $cards = [
            [
                'title' => 'Home',
                'description' => 'Go back to home...',
                'route' => route('home'),
            ],
            [
                'title' => 'Integer',
                'description' => 'Generate random integer sequence...',
                'route' => route('generator.get.numbers.sequence.integer'),
            ],
            [
                'title' => 'Decimal',
                'description' => 'Generate random decimal sequence...',
                'route' => route('generator.get.numbers.sequence.decimal'),
            ],
            [
                'title' => 'Boolean (binary)',
                'description' => 'Generate random boolean (binary) sequence...',
                'route' => route('generator.get.numbers.sequence.boolean'),
            ]
        ];
        return view('numbers', compact('cards'));
    }

    final public function strings(): Renderable {
        $cards = [
            [
                'title' => 'Home',
                'description' => 'Go back to home...',
                'route' => route('home'),
            ],
            [
                'title' => 'Char',
                'description' => 'Generate random char sequence...',
                'route' => route('generator.get.strings.sequence.char'),
            ],
            [
                'title' => 'Generated Words',
                'description' => 'Generate random words with chars sequence...',
                'route' => route('generator.get.strings.sequence.word'),
            ],
            [
                'title' => 'Real words',
                'description' => 'Generate random real words sequence...',
                'route' => route('generator.get.strings.sequence.real-word'),
            ]
        ];
        return view('strings', compact('cards'));
    }

    final public function result(string $token): Renderable | RedirectResponse {
        $key = "result:{$token}";
        /**
         * @var Repository $cache
         */
        $cache = cache();
        $result = $cache->get($key);
        if (!$result) {
            return redirect()->route('home')
                ->with('info', 'Result expired, generate new one...');
        }
        $cards = [
            [
                'title' => 'Home',
                'description' => 'Go back to home...',
                'route' => route('home'),
            ],
        ];
        return view('result', compact('result', 'cards'));
    }
}
