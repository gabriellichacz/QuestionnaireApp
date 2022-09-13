@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="row justify-content-center mb-4">
        <div class="col text-center display-6">
            {{ __('Ostatnie wpisy do ankiet') }}
        </div>
    </div>
    <!-- end of Header -->

    <!-- Polls list -->
    <div class="row justify-content-center m-3">
        <div class="col text-center">
            @if(!$last_filled_polls) <!-- If there's no filled polls in database -->
                <div class="row m-2">
                    <div class="col text-center display-6"> {{ __('Brak ankiet.') }} </div>
                </div>
            @else <!-- If there are filled polls in database -->
                <div class="row">
                    @foreach ($last_filled_polls as $i => $last_filled_poll)
                        <div class="col-sm-6">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h3 class="card-title"> {{ $last_filled_poll['title'] }} </h3>
                                    <h5 class="card-title"> <!-- timestamp -->
                                        <p class="mb-1"> {{ __('Wypełnione:') }} </p>
                                        <p> {{ $last_filled_poll['created_at'] }} </p> 
                                    </h5>
                                    <a href="/admin/last/{{ $last_filled_poll['URLslug'] }}/{{ $last_filled_poll['entry_id'] }}" 
                                        class="btn btn-link text-white-50 text-decoration-none bg-violet"> 
                                        {{ __('Zobacz wpis') }}
                                    </a>
                                    <a href="/admin/last/{{ $last_filled_poll['URLslug'] }}/{{ $last_filled_poll['entry_id'] }}/delete" 
                                        class="btn btn-link text-white-50 text-decoration-none bg-violet"> 
                                        {{ __('Usuń wpis') }}
                                    </a>
                                    <a href="/poll/{{ $last_filled_poll['URLslug'] }}/edit" 
                                        class="btn btn-link text-white-50 text-decoration-none bg-violet"> 
                                        {{ __('Edytuj ankietę') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="row m-3">
        <div class="col text-center">
            {{ $last_filled_polls->links() }}
        </div>
    </div>
    <!-- end of Polls list -->

</div>

@endsection
