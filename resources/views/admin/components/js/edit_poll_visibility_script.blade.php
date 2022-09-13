<script>

// Function that reads changes in real time
$(document).ready(function(){ 
    // Reads changes in 'VisibilitySwitch' input
    $("#VisibilitySwitch").change(function(){
        if (this.checked == true) {
            ajax_request('1');
        }
        else {
            ajax_request('0');      
        }
    });
});

// Ajax function to save in database
function ajax_request(visible){
    $.ajax({
        url: '/poll/{{ $poll->URLslug }}/visibility', // Here comes route
        method: 'POST',
        dataType: 'text',
        data: { // Here comes the data
            update: 1,
            visible: visible,
            _token: '{{ csrf_token() }}',
            _method: 'PATCH'
        }, 
        success: function(response){
            console.log("Switch value: " + visible);
            $('.visibility-switch-class').load(document.URL + ' .visibility-switch-class'); // Reloading div class 'visibility-switch-class'
        }
    });
}

</script>