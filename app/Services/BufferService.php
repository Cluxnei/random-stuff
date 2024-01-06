<?php

namespace App\Services;

use Illuminate\Cache\CacheManager;
use Psr\SimpleCache\InvalidArgumentException;

class BufferService
{
    private const buffer_key = 'main_buffer';
    public const buffer_size = 500;
    public const buffer_realtime_size = self::buffer_size * 0.2;

    /**
     * @throws InvalidArgumentException
     */
    final public function pushToBuffer(array $data): void
    {
        $buffer = $this->getFromRawBuffer();
        array_push($buffer, ...$data);
        $buffer = array_slice($buffer, -self::buffer_size);
        $this->setEntireBuffer($buffer);
    }

    final public function getFromRawBuffer(?int $size = null): array
    {
        $buffer = $this->getCacheInterface()->get(self::buffer_key, []);
        $buffer = $this->preventEmptyBuffer($buffer);
        if ($size === null) {
            return $buffer;
        }
        return array_slice($buffer, -$size);
    }

    final public function getFromIntegerBuffer(?int $size = null): array
    {
        $buffer = $this->getFromRawBuffer($size);
        return array_map(static fn(float $item) => (int)($item * mt_getrandmax()), $buffer);
    }

    final public function getFromBooleanBuffer(?int $size = null): array
    {
        $buffer = $this->getFromRawBuffer($size);
        return array_map(static fn(float $item) => $item > 0.5, $buffer);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function setEntireBuffer(array $data): void
    {
        $this->getCacheInterface()->set(self::buffer_key, $data);
    }

    private function getCacheInterface(): CacheManager
    {
        return cache();
    }

    private function preventEmptyBuffer(array $buffer): array
    {
        if (count($buffer) > 0) {
            return $buffer;
        }
        for ($i = 0; $i < self::buffer_size; $i++) {
            $num = mt_rand() / mt_getrandmax();
            if (mt_rand(1, 10) % 2 === 0) {
                $num = -$num;
            }
            $buffer[] = $num;
        }
        return $buffer;
    }
}