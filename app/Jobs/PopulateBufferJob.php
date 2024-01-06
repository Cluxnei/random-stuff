<?php

namespace App\Jobs;

use App\Services\BufferService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Psr\SimpleCache\InvalidArgumentException;

class PopulateBufferJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // silence is golden
    }

    /**
     * Execute the job.
     * @throws InvalidArgumentException
     */
    public function handle(BufferService $bufferService): void
    {
        $numberToMock = (int)(BufferService::buffer_size / 3);
        $part = [];
        for ($i = 0; $i < $numberToMock; $i++) {
            $num = mt_rand() / mt_getrandmax();
            if (mt_rand(1, 10) % 2 === 0) {
                $num = -$num;
            }
            $part[] = $num;
        }
        $bufferService->pushToBuffer($part);
    }
}
