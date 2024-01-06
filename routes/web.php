<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NumberGeneratorController;
use App\Http\Controllers\RealtimeController;
use App\Http\Controllers\StringGeneratorController;
use Illuminate\Support\Facades\Route;

// Navigation routes
Route::prefix('/')->group(static function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/result/{token}', [HomeController::class, 'result'])->name('result');
    Route::get('/numbers', [HomeController::class, 'numbers'])->name('numbers.index');
    Route::get('/strings', [HomeController::class, 'strings'])->name('strings.index');
    Route::get('/realtime-data', [RealtimeController::class, 'index'])->name('realtime.index');
});
// Generator routes
Route::prefix('/generator/get/')->name('generator.get.')->group(static function() {
    // numbers
    Route::prefix('/numbers')->name('numbers.')->group(static function() {
        Route::get('/sequence/integer', [NumberGeneratorController::class, 'getIntegerSequence'])->name('sequence.integer');
        Route::get('/sequence/decimal', [NumberGeneratorController::class, 'getDecimalSequence'])->name('sequence.decimal');
        Route::get('/sequence/boolean', [NumberGeneratorController::class, 'getBooleanSequence'])->name('sequence.boolean');
    });
    // strings
    Route::prefix('/strings')->name('strings.')->group(static function() {
        Route::get('/sequence/char', [StringGeneratorController::class, 'getCharSequence'])->name('sequence.char');
        Route::get('/sequence/words', [StringGeneratorController::class, 'getWordSequence'])->name('sequence.word');
        Route::get('/sequence/real-words', [StringGeneratorController::class, 'getRealWordSequence'])->name('sequence.real-word');
    });
});
