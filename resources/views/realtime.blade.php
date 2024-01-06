@extends('layouts.base')

@section('subtitle', 'Realtime Data')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="mt-16 dark:text-white">
            {{ implode(', ', $buffer) }}
        </div>

        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                Copyright, Random Stuff {{ now()->format('Y') }}, all rights reserved.
            </div>
        </div>
    </div>
@endsection