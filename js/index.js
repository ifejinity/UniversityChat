$(document).ready(()=> {
    $("#signin").click((event)=>{
        event.preventDefault(); // Prevent the form from submitting normally
        $("#loader").css('display', 'flex');
        var formData = $("#signinForm").serialize();

        $.ajax({
            url: './php/signin.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $("#loader").hide();
                window.location.href = './pages/home.php';
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                $("#modalResponse").css('display', 'flex');
                $("#response").html(`
                    <h1 class="font-bold text-[20px] text-center">Sign in Failed!</h1>
                `);
            }
        });
    });
});

$("#closeModal").click(()=>{
    $("#modalResponse").hide();
});