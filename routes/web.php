<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NumberGeneratorController;
use App\Http\Controllers\RealtimeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/realtime-data', [RealtimeController::class, 'index'])->name('realtime.index');
Route::get('/result/{token}', [HomeController::class, 'result'])->name('result');
Route::get('/numbers', [HomeController::class, 'numbers'])->name('numbers.index');
Route::get('/generator/get/numbers/sequence/integer', [NumberGeneratorController::class, 'getIntegerSequence'])->name('generator.get.numbers.sequence.integer');
Route::get('/generator/get/numbers/sequence/decimal', [NumberGeneratorController::class, 'getDecimalSequence'])->name('generator.get.numbers.sequence.decimal');
Route::get('/generator/get/numbers/sequence/boolean', [NumberGeneratorController::class, 'getBooleanSequence'])->name('generator.get.numbers.sequence.boolean');
