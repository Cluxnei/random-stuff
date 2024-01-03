<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NumberGeneratorController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/result/{token}', [HomeController::class, 'result'])->name('result');
Route::get('/numbers', [HomeController::class, 'numbers'])->name('numbers.index');
Route::get('/generator/get/numbers/sequence/integer', [NumberGeneratorController::class, 'getIntegerSequence'])->name('generator.get.numbers.sequence.integer');
