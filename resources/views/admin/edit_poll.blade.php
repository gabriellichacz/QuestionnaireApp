@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="row justify-content-center mb-4">
    <div class="col text-center display-6">
        {{ __('Edytuj ankietę') }}
    </div>
</div>
<!-- end of Header -->

<!-- Edit poll title and URLslug -->
<div class="edit-poll-title-URLslug">
    @include('admin.components.edit_poll_properties') 
</div>
<!-- end of Edit poll title and URLslug -->

<div class="row justify-content-center mb-4">

    <!-- Change visibility -->
    <div class="row visibility-switch-class m-2">
        <div class="col text-center">
            <div class="form-check form-switch">
                @if ($poll->visible == 0)
                    <input class="form-check-input" type="checkbox" id="VisibilitySwitch" name="VisibilitySwitch">
                    <label class="form-check-label" for="VisibilitySwitch"> {{ __('ankieta niewidoczna') }}   </label>
                @elseif ($poll->visible == 1)
                    <input class="form-check-input" type="checkbox" id="VisibilitySwitch" name="VisibilitySwitch" checked>
                    <label class="form-check-label" for="VisibilitySwitch"> {{ __('ankieta widoczna') }}  </label>
                @endif
            </div>
        </div>
    </div>
    <!-- end of Change visibility -->

    <!-- Add question -->
    <div class="row text-center m-2">
        <div class="col text-center">
            <button type="button" class="btn text-white-50 text-decoration-none bg-violet" data-bs-toggle="modal" data-bs-target="#add_question_modal"> 
                {{ __('Dodaj nowe pytanie') }} 
            </button>
        </div>
    </div>
    <!-- end of Add question -->

</div>

<!-- ------------Invisible things below------------ -->

<!-- Displaying question list -->
<div class="all-questions-body">
    @include('admin.components.display_questions', ['question_array' => $question_array]) 
</div>

<!-- Create a question modal form -->
@include('admin.components.create_question') 

<!-- Changing visiblity script -->
@include('admin.components.js.edit_poll_visibility_script')

@endsection