@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col text-center">
            {{ __('Liczba odpowiedzi na ankietę:') }} {{ $number_of_answers }}
        </div>
    </div>
</div>

@include('admin.components.summary_display_questions')

@endsection