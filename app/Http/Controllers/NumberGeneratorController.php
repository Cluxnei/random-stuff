<?php

namespace App\Http\Controllers;

use App\Helpers\Result;
use App\Services\RandomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Psr\SimpleCache\InvalidArgumentException;

class NumberGeneratorController extends Controller
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
    final public function getIntegerSequence(): RedirectResponse
    {
        $sequence = $this->randomService->generateRandomIntegerSequence(50);
        $sequence = implode(', ', $sequence);
        return Result::resultPage($sequence);
    }

    /**
     * @throws InvalidArgumentException
     */
    final public function getDecimalSequence(): RedirectResponse
    {
        $sequence = $this->randomService->generateRandomDecimalSequence(50);
        $sequence = implode(', ', $sequence);
        return Result::resultPage($sequence);
    }

    /**
     * @throws InvalidArgumentException
     */
    final public function getBooleanSequence(): RedirectResponse
    {
        $sequence = $this->randomService->generateRandomBooleanSequence(50);
        $sequence = implode(', ', array_map(static fn(bool $bool) => (int)$bool, $sequence));
        return Result::resultPage($sequence);
    }
}
