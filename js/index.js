$("#modalResponse").hide();

$(document).ready(()=> {
    $("#signin").click((event)=>{
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $("#signinForm").serialize();

        $.ajax({
            url: './php/signin.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                window.location.href = './pages/home.php';
            },
            error: function(xhr, status, error) {
                $("#modalResponse").show();
                $("#response").html(`
                    <h1 class="font-bold text-[25px] text-center">Sign in Failed!</h1>
                `);
            }
        });
    });
});

$("#closeModal").click(()=>{
    $("#modalResponse").hide();
});