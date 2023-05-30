$(window).on('load', function(){
    CheckProgress();
});

function CheckProgress(){
    if(sessionStorage.progress == null){
        $("#form1").css('display', 'flex');
        $("#form2").hide();
        $("#form3").hide();
    }
    if(sessionStorage.progress == "2"){
        $("#form1").hide();
        $("#form3").hide();
        $("#form2").css('display', 'flex');
    }
    if(sessionStorage.progress == "3"){
        $("#form2").hide();
        $("#form1").hide();
        $("#form3").css('display', 'flex');
    }
}

// send code
$("#sendcode").click(function(e){
    e.preventDefault();
    if($("#studentid").val() == ""){ 
        $("#failedresponse").html("Student ID is required");
        $("#modalResponseFailed").css('display', 'flex');
    }

    else{
        $("#loader").css('display', 'flex');
        var formData = $("#forgotpassword").serialize();
        $.ajax({
            url: '../php/sendcode.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $("#loader").hide();
                $("#successresponse").html("The verification code will be sent to your email associated to your account");
                $("#modalResponseSuccess").css('display', 'flex');
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                $("#failedresponse").html("Invalid Student ID");
                $("#modalResponseFailed").css('display', 'flex');
            }
        });
    }
});

// verified code
$("#change").click(function(e){
    e.preventDefault();
    var formData = $("#forgotpassword").serialize();

    if ($("#code").val() == "" || $("#studentid").val() == ""){
        $("#loader").hide();
        $("#successresponse").html("All fields are required");    
        $("#modalResponseSuccess").css('display', 'flex');
    }
    else{
        $("#loader").css('display', 'flex');

        $.ajax({
            url: '../php/verifiedcode.php', 
            type: 'POST',
            data: formData,
            success: function(response) {
                $("#loader").hide();
                sessionStorage.progress = "2";
                CheckProgress();
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                $("#failedresponse").html("Verification failed");
                $("#modalResponseFailed").css('display', 'flex');
            }
        });
    }
});

// changepassword
$("#changepass").click(function(e){
    e.preventDefault();
    var formData = $("#changepassword").serialize();

    if ($("#pass").val() == "" || $("#vpass").val() == ""){
        $("#loader").hide();
        $("#successresponse").html("All fields are required");
        $("#modalResponseSuccess").css('display', 'flex');
    }
    else{
        $("#loader").css('display', 'flex');
        $.ajax({
            url: '../php/changepassword.php', 
            type: 'POST',
            data: formData,
            success: function(response) {
                $("#loader").hide();
                sessionStorage.progress = "3";
                CheckProgress();
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                $("#failedresponse").html("Password Verification failed");
                $("#modalResponseFailed").css('display', 'flex');
            }
        });
    }
});

$("#closeModalFailed").click(()=>{
    $("#modalResponseFailed").hide();
});

$("#closeModalSuccess").click(()=>{
    $("#modalResponseSuccess").hide();
});

$("#done").click(function(){
    sessionStorage.removeItem('progress');
})