@extends('layouts.base')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="mt-16">
            @include('components.cards', ['cards' => $cards])
        </div>

        @include('layouts.copyright')
    </div>
@endsection