$("#modalResponseSuccess").hide();
$("#modalResponseFailed").hide();
$("#loader").hide();

$("#consent").click(function(){
    this.checked ? $("#signup").prop('disabled', false) : $("#signup").prop('disabled', true);
});

$(document).ready(function() {
    $('#signupForm').submit(function(event) {
    $("#loader").show();

        event.preventDefault(); // Prevent the form from submitting normally

        var formData = $(this).serialize();

        $.ajax({
            url: '../php/signup.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $("#loader").hide();
                $("#modalResponseSuccess").show();
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                $("#modalResponseFailed").show();
            }
        });
    });
});

$("#closeModalFailed").click(()=>{
    $("#modalResponseFailed").hide();
});