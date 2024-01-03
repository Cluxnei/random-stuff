<?php

namespace App\Http\Controllers;

use App\Helpers\Result;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NumberGeneratorController extends Controller
{
    final public function getIntegerSequence(): RedirectResponse
    {
        $size = 10000;
        $sequence = [];
        for ($i = 0; $i < $size; $i++) {
            $sequence[] = rand(-PHP_INT_MAX, PHP_INT_MAX);
        }
        $sequence = implode(', ', $sequence);
        return Result::resultPage($sequence);
    }
}
