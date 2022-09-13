<!-- modal form - create new question -->
<div class="modal fade" id="add_question_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <!-- Create question form -->
                <form name="store_new_question" id="store_new_question">
                    <div class="row justify-content-center display-6"> {{ __('Dodaj nowe pytanie') }} </div>
                    <div class="row justify-content-center">
                        <!-- Data row -->
                        <div class="form-group row">
                            <!-- Label -->
                            <label for="question" class="col-md-4 col-form-label"> {{ __('Pytanie') }} </label>
                            <!-- Text input field -->
                            <input name="question" id="question" type="text" class="form-control" 
                                placeholder="Wpisz pytanie" value="{{ old('question') }}"> <!-- value old() keeps the old value if there was an error in input -->
                            <!-- Show small red text if there is an error in input -->
                            @error('question')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <!-- end of Data row -->

                        <!-- Answer types -->
                        <div class="form-group row">
                            <label for="formmm1"> {{ __('Typ odpowiedzi') }} </label>
                            <div class="form-check" id="formmm1">
                                <input class="form-check-input" type="radio" name="answer_type" id="answer_type2" value="0">
                                <label class="form-check-label" for="flexRadioDefault2"> {{ __('Tekstowe') }} </label>
                                <!-- Show small red text if there is an error in input -->
                                @error('answer_type')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer_type" id="answer_type1" value="1">
                                <label class="form-check-label" for="flexRadioDefault1"> {{ __('Tak lub nie') }} </label>
                                <!-- Show small red text if there is an error in input -->
                                @error('answer_type')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        <!-- end of Answer types -->
                            
                        <!-- Apply button -->
                        <button class="btn btn-link text-white-50 text-decoration-none m-3 bg-violet"> 
                            {{ __('Dodaj pytanie') }}
                        </button>
                        <!-- end of Apply button -->
                    </div>
                </form>
                <!-- end of Create question form -->

            </div>
        </div>
    </div>
</div>
<!-- end of modal form - create new question -->

<!-- JS script with Ajax method -->
@include('admin.components.js.new_question_script')