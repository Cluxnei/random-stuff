<?php

namespace App\Services;

use Illuminate\Cache\CacheManager;
use Psr\SimpleCache\InvalidArgumentException;

class BufferService
{
    private const buffer_key = 'main_buffer';

    /**
     * @throws InvalidArgumentException
     */
    final public function pushToBuffer(array $data): void
    {
        $buffer = $this->getFromBuffer();
        array_push($buffer, ...$data);
        $this->setEntireBuffer($buffer);
    }

    final public function getFromBuffer(): array
    {
        return $this->getCacheInterface()->get(self::buffer_key, []);
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