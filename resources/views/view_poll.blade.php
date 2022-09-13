@extends('layouts.app')

@section('content')

@if ($poll->visible == 0) <!-- if poll is made invisible -->
    <!-- do nothing -->
@elseif ($poll->visible == 1) <!-- if poll is made visible -->

    <div class="container">

        <!-- Header -->
        <div class="row justify-content-center mb-4">
            <div class="col text-center display-6">
                {{ $poll -> title }}
            </div>
        </div>
        <!-- end of Header -->

        <!-- Displaying questions -->
        <div>
            @if(!$question_array) <!-- If polls table is empty -->
                <div class="row m-2">
                    <div class="col text-center display-6"> {{ __('Brak pytań.') }} </div>
                </div>
            @else <!-- If there are polls in database -->

                <!-- Answers form -->
                <form action="/poll/{{ $poll->URLslug }}/store-answers" enctype="multipart/form-data" method="post">
                    @csrf

                    <!-- Show small red text if there is an error in input -->
                    @error('answer.*')
                        <small class="text-danger"> {{ __('Wszystkie pola są wymagane') }} </small>
                    @enderror

                    @foreach ($question_array as $key => $question) <!-- displaying all questions -->
                        <div class="m-3">
                            <div class="h4">
                                {{ $question_array[$key]['question'] }}
                            </div>
                            <div class="row justify-content-center">
                                @if ($question_array[$key]['answer_type'] == 0)

                                    <!-- Data row -->
                                    <div class="form-group row">
                                        <!-- Text input field -->
                                        <input name="answer[]" id="answer" type="text" class="form-control" 
                                            placeholder="Wpisz pytanie" value="{{ old('answer.$key]') }}"> <!-- value old() keeps the old value if there was an error in input -->
                                    </div>
                                    <!-- end of Data row -->

                                @else

                                    <!-- Yes/No -->
                                    <div class="form-group row">
                                        <div class="form-check" id="formmm1">
                                            <input class="form-check-input" type="radio" name="answer[{{$key}}]" id="answer[{{$key}}]" value="2">
                                            <label class="form-check-label" for="flexRadioDefault2"> {{ __('Tak') }} </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer[{{$key}}]" id="answer[{{$key}}]" value="1">
                                            <label class="form-check-label" for="flexRadioDefault1"> {{ __('Nie') }} </label>
                                        </div>  
                                    </div>
                                    <!-- end of Yes/No -->
                                    
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Apply button -->
                    <div class="m-2 text-center">
                        <button class="btn btn-link text-white-50 text-decoration-none m-3 bg-violet"> 
                            {{ __('Zapisz odpowiedzi') }}
                        </button>
                    </div>
                    <!-- end of Apply button -->

                </form>
                <!-- end of Answers form -->
                
            @endif
        </div>
        <!-- end of Displaying questions -->

    </div>

@endif

@endsection
