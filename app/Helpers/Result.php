<?php

namespace App\Helpers;

use Illuminate\Http\RedirectResponse;

class Result
{
    final public static function resultPage(string $value): RedirectResponse
    {
        $token = md5($value);
        $key = "result:{$token}";
        return redirect()->route('result', [$token])->with($key, $value);
    }
}