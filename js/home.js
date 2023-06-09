$("#signout").click(()=>{
    $("#modalSignout").css('display', 'flex');
})

$("#cancel").click(()=>{
    $("#modalSignout").hide();
})

// Show more
let myLimitval = parseInt($("#limitdata").val());
let myLimitval2 = parseInt($("#limitdata2").val());
$("#conversation").scroll(function() {
    
    if ($(this).scrollTop() === 0) {
        $("#loader").css('display', 'flex');

        let sum = myLimitval += 10;

        $("#limitdata").val(sum);
        $("#limitdata2").val(sum);

        console.log(sum);
    }
});

$(document).ready(()=> {   
    // sign out
    $("#proceed").click((e)=>{
        e.preventDefault(); // Prevent the form from submitting normally
        $("#modalSignout").hide();
        $("#loader").css('display', 'flex');

        $.ajax({
            url: '../php/signout.php',
            success: function(response){
                $("#loader").hide();
                window.location.href = '../index.php';
            }
        });
    });

    // Long polling to continuously check for new messages
    loadMessages();
    function loadMessages() {
        $.ajax({
            url: '../php/reload.php',
            type: 'POST',
            data: {myLoaded: $('#limitdata').val()},
            success: function (response) {
                $("#loader").hide();
                $('#conversation').html(response);
                setTimeout(loadMessages, 1000); // Delay before sending the next request
            }
        });
    }

    // scroll bottom
    var scrollableElement = $("#conversation");
    scrollableElement.scrollTop(scrollableElement[0].scrollHeight);

    // send message
    $("#send").click((e)=>{
        if($("#message").val() != ""){
            e.preventDefault();
            var formData = $("#myMessage").serialize();
            $.ajax({
                url: '../php/home.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $("#conversation").html(response);
                    $("#message").val("");
                    scrollableElement.scrollTop(scrollableElement[0].scrollHeight);
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            });
        }
    });
});