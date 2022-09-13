@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="row justify-content-center mb-4">
        <div class="col text-center display-6">
            {{ $poll->title }}
        </div>
    </div>
    <!-- end of Header -->

    <!-- Displaying all questions -->
    <div class="row m-2">
        @foreach ($questions_array as $key => $question) 
            <h4> {{ $question['question'] }} </h4>
            <div>
                
                <!-- Answers -->
                @if (empty($answers[$key][0]['answer']))
                    <p class="mb-2">
                        {{ __('Pytanie nie istniało w chwili udzielania odpowiedzi przez użytkownika') }}
                    <p>
                @else
                    <p class="mb-2">
                        {{ $answers[$key][0]['answer'] }}
                    <p>
                @endif
                <!-- end of Answers -->
                       
            </div>   
        @endforeach
    </div>
    <!-- end of Displaying all questions -->

</div>

@endsection
