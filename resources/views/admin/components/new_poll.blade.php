<!-- modal form - create new poll -->
<div class="modal fade" id="add_poll_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <!-- create new poll form -->
                <form name="store_new_poll" id="store_new_poll">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="form-group row">
                                <!-- label -->
                                <label for="title" class="col-md-4 col-form-label"> {{ __('Tytuł') }} </label>
                                <!-- text input field -->
                                <input id="title"
                                    type="text"
                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title"
                                    autofocus
                                >
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                <!-- apply button -->
                                <button class="btn btn-link text-white-50 text-decoration-none m-3 bg-violet"> 
                                    {{ __('Zaakceptuj i dodaj ankietę') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of create new poll form -->
                
            </div>
        </div>
    </div>
</div>
<!-- end of modal form - create new poll -->

<!-- JS script with Ajax method -->
@include('admin.components.js.new_poll_script')