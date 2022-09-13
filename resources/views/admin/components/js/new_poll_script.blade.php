<script type="text/javascript">

$('#store_new_poll').on('submit', function(e){
    
    e.preventDefault();
    let title = $('#title').val(); // Taking value from input field

    // Ajax call to save in database
    $.ajax({
        url: '/store-new-poll', // Here comes route
        method: 'POST',
        dataType: 'text',
        data: { // Here comes the data
            title: title,
            _token: '{{ csrf_token() }}'
        }, 
        success: function(response){
            $('.all-polls-body').load(document.URL + ' .all-polls-body'); // Reloading div class 'all-polls-body'
            $('#add_poll_modal').modal('toggle'); // Closing modal form after submiting
        }
    });

});

</script>