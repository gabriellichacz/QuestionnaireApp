<script type="text/javascript">

$('#store_new_question').on('submit', function(e){
    
    e.preventDefault();
    let question = $('#question').val(); // Taking values from input fields
    let answer_type = document.querySelector('input[name="answer_type"]:checked').value; // Taking radio button value from name and not ID

    // Ajax call to save in database
    $.ajax({
        url: '/poll/{{ $poll->URLslug }}/questions', // Here comes route 
        method: 'POST',
        dataType: 'text',
        data: { // Here comes the data
            question: question,
            answer_type: answer_type,
            _token: '{{ csrf_token() }}'
        }, 
        success: function(response){
            $('.all-questions-body').load(document.URL + ' .all-questions-body'); // Reloading div class 'all-questions-body'
            $('#add_question_modal').modal('toggle'); // Closing modal form after submiting
        }
    });

});

</script>