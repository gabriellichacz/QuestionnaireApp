<div class="container">
    @if(!$questions_array) <!-- if there's no questions in database -->
        <div class="row m-2">
            <div class="col text-center display-6"> {{ __('Brak pytań.') }} </div>
        </div>
    @elseif(!$answers && $questions_array) <!-- if there's no answers in database but there are questions -->
        <div class="row m-2">
            @foreach ($questions_array as $key => $question) <!-- Displaying all questions -->
            <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> {{ $questions_array[$key]['question'] }} </h4>
                            <div class="card-text">
                                {{ __('Brak odpowiedzi.') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else <!-- if there are answers and questions in database -->

        <!-- Displaying all questions -->
        <div class="row m-2">
            @foreach ($questions_array as $key => $question) 
                <div class="col-3">
                    <div class="card">
                        <h4 class="card-header"> {{ $question['question'] }} </h4>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                                <!-- Yes/No count -->
                                @if ($question['answer_type'] == 1)
                                    <li class="list-group-item">
                                        <div>
                                            {{ __('Liczba tak:') }} {{ $answers_yes_sum[$key] }}
                                        </div>
                                        <div>
                                            {{ __('Liczba nie:') }} {{ $answers_no_sum[$key] }}
                                        </div>
                                    </li>
                                @endif
                                <!-- end of Yes/No count -->

                                <!-- Answers -->
                                <li class="list-group-item">
                                    @foreach ($answers[$key] as $j => $answer)
                                        <p class="mb-2">
                                            {{ $answers[$key][$j]['answer'] }}
                                        <p>
                                    @endforeach
                                </li>
                                <!-- end of Answers -->

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end of Displaying all questions -->

    @endif
</div>