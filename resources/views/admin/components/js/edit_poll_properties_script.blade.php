<script type="text/javascript">

$('#edit_question_properties').on('submit', function(e){
    
    // Taking values from input fields in form
    e.preventDefault();
    let title = $('#title').val(); 
    let URLslug = $('#URLslug').val();

    // URL to redirecting after changing of URL slug
    var url_redirect = '{{ url("/poll/:param1/edit") }}'; // Creating dynamic URL
    url_redirect = url_redirect.replace(':param1', URLslug);

    // If user changed URL slug it's necessary to reload the page
    current_url = {!! json_encode($poll->URLslug) !!}
    if (URLslug == current_url) {
        var reload = 0;
    }
    else {
        var reload = 1;
    };

    // Ajax call to save in database
    $.ajax({
        url: '/poll/{{ $poll->URLslug }}/update', // Here comes the route
        method: 'POST',
        dataType: 'text',
        data: { // Here comes the data
            title: title,
            URLslug: URLslug,
            _token: '{{ csrf_token() }}',
            _method: 'PATCH'
        }, 
        success: function(response){
            $('.edit-poll-title-URLslug').load(document.URL + ' .edit-poll-title-URLslug'); // Reloading div class 'edit-poll-title-URLslug'
            if (reload == 1) { // Reloading page
                window.location = url_redirect;
            };
        }
    });

});

</script>