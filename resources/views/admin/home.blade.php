@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="row justify-content-center mb-4">
        <div class="col text-center display-6">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            {{ __('Panel administratora') }}
        </div>
    </div>
    <!-- end of Header -->

    <!-- Add poll -->
    <div class="row justify-content-center m-3">
        <div class="col-3 text-center m-2">
            <button type="button" class="btn text-white-50 text-decoration-none bg-violet" data-bs-toggle="modal" data-bs-target="#add_poll_modal"> 
                {{ __('Dodaj nową ankietę') }} 
            </button>
        </div>
        <div class="col-4 text-center m-2">
            <a href="/admin/last" class="btn text-white-50 text-decoration-none bg-violet"> 
                {{ __('Pokaż ostatnio wypełnione ankiety') }} 
            </a>
        </div>
    </div>
    <!-- end of Add poll -->

    <!-- List of polls -->
    <div class="all-polls-body">
        @include('admin.components.poll_list', ['polls_array' => $polls_array])
    </div>
    
</div>

<!-- Modal form for adding new poll (id: add_poll_modal) -->
@include('admin.components.new_poll')

@endsection
