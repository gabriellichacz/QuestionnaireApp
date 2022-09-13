<!-- Displaying questions -->
<div class="container text-center" id="page-content">
    
    <!-- Draggable Cards -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-text"> {{__('Pytania')}} </h5>
        </div>
        <div class="card-body">
            <div class="row" id="sortable">
                @if(!$question_array) <!-- If polls table is empty -->
                    <div class="row m-2">
                        <div class="col text-center display-6"> {{ __('Brak pytań.') }} </div>
                    </div>
                @else <!-- If there are polls in database -->
                    @foreach ($question_array as $key => $question) <!-- Displaying all questions -->
                        <div data-index="{{ $question_array[$key]['id'] }}" data-position="{{ $question_array[$key]['orderID'] }}">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> {{ $question_array[$key]['question'] }} </h4>
                                    <div class="card-text">
                                        @if ($question_array[$key]['answer_type'] == 0)
                                            {{ __('Typ pytania: tekstowe') }}
                                        @else
                                            {{ __('Typ pytania: tak lub nie') }}
                                        @endif
                                    </div>
                                    <div class="card-text">
                                        <button onclick="delete_question( {{ $question_array[$key]['id'] }} , '{{ $question_array[$key]['question'] }}' )" 
                                            class="btn text-white-50 text-decoration-none bg-violet"> 
                                            {{ __('Usuń pytanie') }} 
                                        </button>
                                        <a href="/poll/{{ $poll -> URLslug }}/question/{{ $question_array[$key]['id'] }}/edit" 
                                            class="btn btn-link text-white-50 text-decoration-none m-3 bg-violet"> 
                                            {{ __('Edytuj pytanie') }} 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- end of Draggable Cards -->

</div>
<!-- end of Displaying questions -->

<!-- JS scripts with Ajax methods -->
@include('admin.components.js.edit_poll_questions_order')
@include('admin.components.js.delete_question_script')