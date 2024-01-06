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

    final public function generateRandomDecimalSequence(int $length): array
    {
        $buffer = $this->bufferService->getFromRawBuffer();
        shuffle($buffer);
        return array_slice($buffer,  0, $length);
    }

    final public function generateRandomBooleanSequence(int $length): array
    {
        $buffer = $this->bufferService->getFromBooleanBuffer();
        shuffle($buffer);
        return array_slice($buffer,  0, $length);
    }

    final public function generateRandomCharSequence(int $length): array
    {
        $buffer = $this->bufferService->getFromCharBuffer();
        shuffle($buffer);
        return array_slice($buffer,  0, $length);
    }

    final public function generateRandomWordSequence(int $length): array
    {
        $buffer = collect($this->bufferService->getFromCharBuffer(null, 65, 122))
            ->filter(static function(string $char) {
                $val = ord($char);
                return $val < 91 || $val > 96;
            })
            ->shuffle();
        $words = [];
        for ($i = 0; $i < $length; $i++) {
            $wordLen = mt_rand(2, 10);
            $word = $buffer->random($wordLen)->implode('');
            $words[] = $word;
        }
        return $words;
    }

    final public function generateRandomRealWordSequence(int $length): array
    {
        $buffer = $this->bufferService->getFromIntegerBuffer();
        shuffle($buffer);
        return array_slice($buffer,  0, $length);
    }
}