<!-- List of polls -->
<div class="row justify-content-center mb-2">
    <div class="col-8">
        @if(!$polls_array) <!-- If polls table is empty -->
            <div class="row m-2">
                <div class="col text-center display-6"> {{ __('Brak ankiet.') }} </div>
            </div>
        @else <!-- If there are polls in database -->
            @foreach ($polls_array as $i => $poll)
                <div class="row m-1">
                    <div class="col text-center btn text-decoration-none bg-white"> 
                        {{ $polls_array[$i]['title'] }} 
                    </div>
                    <div class="col-sm-2"> 
                        <a href="/poll/{{ $polls_array[$i]['URLslug'] }}/summary" class="btn text-white-50 text-decoration-none bg-violet"> {{ __('Wyniki') }} </a> 
                    </div>
                    <div class="col-sm-2">
                        <a href="/poll/{{ $polls_array[$i]['URLslug'] }}/edit" class="btn text-white-50 text-decoration-none bg-violet"> {{ __('Edytuj') }} </a>
                    </div>
                    <div class="col-sm-2">
                        <button onclick="delete_poll( '{{ $polls_array[$i]['URLslug'] }}', '{{ $polls_array[$i]['title'] }}' )" 
                            class="btn text-white-50 text-decoration-none bg-violet"> {{ __('Usuń') }} </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<!-- end of List of polls -->

<!-- JS script with Ajax method -->
@include('admin.components.js.delete_poll_script')