<?php

namespace App\Http\Controllers;

use App\Helpers\Result;
use App\Services\RandomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Psr\SimpleCache\InvalidArgumentException;

class StringGeneratorController extends Controller
{
    public function __construct(
        private readonly RandomService $randomService
    )
    {
        //
    }

    /**
     * @throws InvalidArgumentException
     */
    final public function getCharSequence(): RedirectResponse
    {
        $sequence = $this->randomService->generateRandomCharSequence(50);
        $sequence = implode(', ', $sequence);
        return Result::resultPage($sequence);
    }

    /**
     * @throws InvalidArgumentException
     */
    final public function getWordSequence(): RedirectResponse
    {
        $sequence = $this->randomService->generateRandomWordSequence(50);
        $sequence = implode(', ', $sequence);
        return Result::resultPage($sequence);
    }

    /**
     * @throws InvalidArgumentException
     */
    final public function getRealWordSequence(): RedirectResponse
    {
        $sequence = $this->randomService->generateRandomRealWordSequence(50);
        $sequence = implode(', ', $sequence);
        return Result::resultPage($sequence);
    }
}
