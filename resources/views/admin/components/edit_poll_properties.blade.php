<!-- Edit poll form -->
<form name="edit_question_properties" id="edit_question_properties">
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-2 justify-content-center text-center">

            <!-- Data row -->
            <div class="form-group row"> <!-- If you want to edit more data, add more form-group row like this one -->
                <!-- Label -->
                <label for="title" class="col-md-4 col-form-label"> {{ __('Tytuł') }} </label>
                <!-- Text input field -->
                <input id="title"
                    type = "text"
                    class = "form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                    name = "title"
                    value = "{{ $poll->title ?? '' }}"
                    autocomplete = "title" autofocus>
                    
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <!-- end of Data row -->

            <!-- Data row -->
            <div class="form-group row">
                <!-- Label -->
                <label for="URLslug" class="col-md-4 col-form-label"> {{ __('URL slug') }} </label>
                <!-- Text input field -->
                <input id="URLslug"
                    type = "text"
                    class = "form-control {{ $errors->has('URLslug') ? ' is-invalid' : '' }}"
                    name = "URLslug"
                    value = "{{ $poll->URLslug ?? '' }}"
                    autocomplete = "URLslug" autofocus>
                    
                @if ($errors->has('URLslug'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('URLslug') }}</strong>
                    </span>
                @endif
            </div>
            <!-- end of Data row -->

            <!-- Apply button -->
            <button class="btn btn-link text-white-50 text-decoration-none m-3 bg-violet"> 
                {{ __('Zaakceptuj edycję') }}
            </button>
            <!-- end of Apply button -->
        </div>
    </div>
</form>
<!-- end of Edit poll form -->

@include('admin.components.js.edit_poll_properties_script')
