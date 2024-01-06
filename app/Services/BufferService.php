<?php

namespace App\Services;

use Illuminate\Cache\CacheManager;
use Psr\SimpleCache\InvalidArgumentException;

class BufferService
{
    private const buffer_key = 'main_buffer';
    private const buffer_size = 500;
    public const buffer_realtime_size = self::buffer_size * 0.2;

    /**
     * @throws InvalidArgumentException
     */
    final public function pushToBuffer(array $data): void
    {
        $buffer = $this->getFromBuffer();
        array_push($buffer, ...$data);
        $buffer = array_slice($buffer, -self::buffer_size);
        $this->setEntireBuffer($buffer);
    }

    final public function getFromBuffer(?int $size = null): array
    {
        $buffer = $this->getCacheInterface()->get(self::buffer_key, []);
        if ($size === null) {
            return $buffer;
        }
        return array_slice($buffer, -$size);
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
}