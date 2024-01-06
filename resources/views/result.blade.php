@extends('layouts.base')

@section('subtitle', 'Result')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        @include('components.cards', ['cards' => $cards])

        <div class="mt-16 dark:text-white">
            {{ $result }}
        </div>

        @include('layouts.copyright')
    </div>
@endsection