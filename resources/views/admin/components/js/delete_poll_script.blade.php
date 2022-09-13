<script type="text/javascript">

function delete_poll(poll_URLslug, poll_title) { // Reading loop index
    
    var url_js = '{{ url("/poll/:param1/delete") }}'; // Creating dynamic URL
    url_js = url_js.replace(':param1', poll_URLslug);

    if (confirm("Czy na pewno chcesz usunąć ankietę '" + poll_title + "'?") == true) { // Confirmation
        $.ajax({
            url: url_js, // Here comes the route
            method: 'GET',
            success: function(response){
                $('.all-polls-body').load(document.URL + ' .all-polls-body'); // Reloading div class 'all-polls-body'
            }
        });
    };

};

</script>