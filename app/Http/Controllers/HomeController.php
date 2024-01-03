<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    final public function index(): Renderable {
        $cards = [
            [
                'title' => 'Numbers',
                'description' => 'Generate random number sequences...',
                'route' => route('numbers.index'),
            ]
        ];
        return view('home', compact('cards'));
    }

    final public function numbers(): Renderable {
        $cards = [
            [
                'title' => 'Integer',
                'description' => 'Generate random integer sequence...',
                'route' => route('generator.get.numbers.sequence.integer'),
            ]
        ];
        return view('numbers', compact('cards'));
    }

    final public function result(string $token): Renderable | RedirectResponse {
        $key = "result:{$token}";
        if (!session()->has($key)) {
            return redirect()->route('home')
                ->with('info', 'Result expired, generate new one...');
        }
        $result = session($key);
        return view('result', compact('result'));
    }
}
