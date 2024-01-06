<?php

namespace App\Helpers;

use Illuminate\Cache\Repository;
use Illuminate\Http\RedirectResponse;
use Psr\SimpleCache\InvalidArgumentException;

class Result
{
    /**
     * @throws InvalidArgumentException
     */
    final public static function resultPage(string $value): RedirectResponse
    {
        $token = md5($value);
        $key = "result:{$token}";
        /**
         * @var Repository $cache
         */
        $cache = cache();
        $cache->set($key, $value, now()->addMinutes(5));
        return redirect()->route('result', [$token]);
    }
}