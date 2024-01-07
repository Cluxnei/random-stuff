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
        $cards = [
            [
                'title' => 'Home',
                'description' => 'Go back to home...',
                'route' => route('home'),
            ],
        ];
        $buffer = $this->bufferService->getFromRawBuffer();
        shuffle($buffer);
        $buffer = array_slice($buffer, 0, BufferService::buffer_realtime_size);
        return view('realtime', compact('buffer', 'cards'));
    }
}
