@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="row justify-content-center mb-4">
        <div class="col text-center display-6">
            {{ __('Lista ankiet') }}
        </div>
    </div>
    <!-- end of Header -->

    <!-- Polls list -->
    <div class="row justify-content-center m-3">
        <div class="col text-center">
            @if(!$polls_array) <!-- If polls table is empty -->
                <div class="row m-2">
                    <div class="col text-center display-6"> {{ __('Brak ankiet.') }} </div>
                </div>
            @else <!-- If there are polls in database -->
                <div class="row">
                    @foreach ($polls_array as $i => $poll)
                        @if ($poll->visible == 0) <!-- if poll is made invisible -->
                            <!-- do nothing -->
                        @elseif ($poll->visible == 1) <!-- if poll is made visible -->
                            <div class="col-sm-6">
                                <div>
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $polls_array[$i]['title'] }} </h5>
                                        <a href="/poll/{{ $polls_array[$i]['URLslug'] }}" class="btn btn-link text-white-50 text-decoration-none bg-violet"> 
                                            {{ __('Wypełnij') }} 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="row m-3">
        <div class="col text-center">
            {{ $polls_array->links() }}
        </div>
    </div>
    <!-- end of Polls list -->


</div>

@endsection
