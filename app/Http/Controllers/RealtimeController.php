<?php

namespace App\Http\Controllers;

use App\Services\BufferService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class RealtimeController extends Controller
{

    public function __construct(
        private readonly BufferService $bufferService
    )
    {
        //
    }

    final public function index(): Renderable
    {
        $buffer = $this->bufferService->getFromRawBuffer(BufferService::buffer_realtime_size);
        return view('realtime', compact('buffer'));
    }
}
