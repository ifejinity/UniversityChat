$("#modalResponse").hide();

$(document).ready(function() {
    $('#signupForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var formData = $(this).serialize();

        $.ajax({
            url: '../php/signup.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $("#modalResponse").show();
                $("#response").html(`
                    <h1 class="font-bold text-[25px] text-center">Successfully created Account!</h1>
                `);
                        // Handle the response here
            },
            error: function(xhr, status, error) {
                $("#modalResponse").show();
                $("#response").html(`
                    <h1 class="font-bold text-[25px] text-center">Failed to create an Account!</h1>
                `);
            }
        });
    });
});

$("#closeModal").click(()=>{
    $("#modalResponse").hide();
});