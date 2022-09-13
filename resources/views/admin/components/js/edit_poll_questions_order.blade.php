<script type="text/javascript">

// Using jquery sortable
$(document).ready(function() {
    $("#sortable").sortable({

        update: function (event, ui) { // Update method
            $(this).children().each( function (index) { // Updating children of current item
                if ( $(this).attr('data-position') != (index+1) ) { // If data-position attribute is not equal to index
                    $(this).attr('data-position', (index+1)).addClass('updated'); // Adding class 'updated'
                }
            });

            saveNewPositions(); // Using this function to store updated indices to database
        }
        
    });
});

// Saving positions in database
function saveNewPositions() {
    var positions = []; // Empty array variable

    // Function that reads data
    $('.updated').each( function () { // Going through all 'updated' classes
        positions.push([$(this).attr('data-index'), $(this).attr('data-position')]) // Pushing array data with current index and position to 'positions' array
        $(this).removeClass('updated'); // Removing 'updated' class after saving
    });

    // Ajax call to save in database
    $.ajax({
        url: '/poll/{{ $poll->URLslug }}/edit/change-order', // Here comes route
        method: 'POST',
        dataType: 'text',
        data: { // Here comes the data
            update: 1,
            positions: positions,
            _token: '{{ csrf_token() }}'
        }, success: function (response) {
            console.log(response);
        }
    });
}

</script>