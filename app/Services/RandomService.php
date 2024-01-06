<?php

namespace App\Services;

class RandomService
{
    public function __construct(
        private readonly BufferService $bufferService
    )
    {
        //
    }

    final public function generateRandomIntegerSequence(int $length): array
    {
        $buffer = $this->bufferService->getFromIntegerBuffer();
        shuffle($buffer);
        return array_slice($buffer,  0, $length);
    }
}