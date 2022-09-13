<script type="text/javascript">

function delete_question( question_id, question_name ) { // Reading loop index
    var poll = {!! json_encode($poll) !!}; // Getting current poll

    var url_js = '{{ url("/poll/:param1/question/:param2/delete") }}'; // Creating dynamic URL
    url_js = url_js.replace(':param1', poll['URLslug']);
    url_js = url_js.replace(':param2', question_id);

    if (confirm("Czy na pewno chcesz usunąć pytanie '" + question_name + "'?") == true) {
        $.ajax({
            url: url_js, // Here comes the route 
            method: 'GET',
            success: function(){
                $('.all-questions-body').load(document.URL + ' .all-questions-body'); // Reloading div class 'all-questions-body'
            }
        });
    };

};

</script>