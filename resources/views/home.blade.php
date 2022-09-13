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
            {{ __('Panel użytkownika') }}
        </div>
    </div>
    <!-- end of Header -->

    <!-- Poll list button -->
    <div class="row justify-content-center m-3">
        <div class="col text-center">
            <a href="/poll-list" class="btn btn-link text-white-50 text-decoration-none m-3 bg-violet"> 
                {{ __('Lista ankiet') }} 
            </a>
        </div>
    </div>
    <!-- end of Poll list button -->

</div>



@endsection
