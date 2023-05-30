<?php
    session_start();
    error_reporting(0);
    if($_SESSION["studentid"] != ""){
        header("location: ./pages/home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../src/resources/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>University Chat | Forgot Password</title>
</head>
<body class="bg-blue-50 md:h-screen h-full w-full overflow-x-hidden justify-center flex items-center flex-col font-outfit">

    <!-- loader -->
    <div class="fixed top-0 bg-white/80 w-full h-screen hidden justify-center items-center z-[1] flex-col gap-20" id="loader">
        <div class="relative">
            <div class="loader">
                <div class="dots"></div>
            </div>
            <div class="loader">
                <div class="dot"></div>
            </div>
            <div class="loader">
                <div class="dot"></div>
            </div>
            <div class="loader">
                <div class="dot"></div>
            </div>
            <div class="loader">
                <div class="dot"></div>
            </div>
            <div class="loader">
                <div class="dot"></div>
            </div>
        </div>
        <div>
            <h1 class="text-[1rem]">Please wait</h1>
        </div>
    </div>

    <!-- modal response failed-->
    <div id="modalResponseFailed" class="fixed top-0 bg-black/30 w-full h-screen z-[10] justify-center items-center hidden">
        <div class="w-fit h-fit bg-white rounded-lg p-5 flex flex-col justify-center items-center gap-5 md:mx-[10%] mx-[5%]">
            <div class="font-bold text-[20px] text-center" id="failedresponse"></div>
            <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                ring-blue-300 focus:outline-none focus:ring w-fit" id="closeModalFailed">Okay</button>
        </div>
    </div>

    <!-- modal response success -->
    <div id="modalResponseSuccess" class="fixed top-0 bg-black/30 w-full h-screen z-[10] justify-center items-center hidden">
        <div class="w-fit h-fit bg-white rounded-lg p-5 flex flex-col justify-center items-center gap-5 md:mx-[10%] mx-[5%]">
            <div class="font-bold text-[20px] text-center" id="successresponse"></div>
            <button class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                ring-blue-300 focus:outline-none focus:ring w-fit" id="closeModalSuccess">Okay</button>
        </div>
    </div>

    <header class="bg-white py-4 grid grid-cols-header drop-shadow-lg items-center px-[5%] md:px-[10%] fixed top-0 w-full">
        <img class="w-[45px]" src="../src/resources/logo.png" alt="" srcset="">
        <div class="flex gap-4">
            <a href="../index.php" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring">Sign In</a>
            <a href="./signup.php" class="p-3 rounded-lg hover:opacity-80">Sign Up</a>
        </div>
    </header>

    <!-- forgot password form --> 
    <div id="form1" class="hidden flex-col justify-center items-center w-full md:px-[10%] px-[5%] gap-10 mb-10">
        <div class="grid grid-cols-forgotpass justify-center items-center mt-[100px]" id="progress">
            <div class="bg-blue-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">1</p>
            </div>

            <div class="w-[80px] h-1 bg-gray-300">

            </div>

            <div class="bg-gray-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">2</p>
            </div>

            <div class="w-[80px] h-1 bg-gray-300">

            </div>

            <div class="bg-gray-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">3</p>
            </div>
        </div>

        <div class="shadow-2xl bg-white p-5 flex flex-col rounded-lg gap-6 justify-center mb-5 w-full max-w-[500px]">
            <h1 class="text-[25px] font-bold">Forgot Password</h1>
            <form class="flex flex-col gap-5" id="forgotpassword">
                <div class="grid grid-cols-header gap-2">
                    <input class="p-3 outline-none rounded-lg bg-blue-50 w-full" type="number" name="studentid" id="studentid" placeholder="Student ID">
                    <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80 ring-blue-300 focus:outline-none focus:ring w-fit self-center" id="sendcode">Send Code</button>
                </div>

                <input class="p-3 outline-none rounded-lg bg-blue-50 w-full" type="number" name="code" id="code" placeholder="Code">
                <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                    ring-blue-300 focus:outline-none focus:ring w-fit self-center" id="change">Change Password</button>
            </form>
        </div>

        <div>
            <p>1. Please enter your Student ID in the designated field.</p>
            <p>2. Click the "Send code" button. Wait for the verification code to be sent to your email address associated with your account.</p>
            <p>3. Check your email for the verification code. If you don't see it in your inbox, remember to check your spam or junk folder.</p>
            <p>4. Once you have received the verification code, return to the password reset page.</p>
            <p>5. Enter the received verification code in the password reset code field.</p>
            <p>6. Click the "Change password" button to proceed with resetting your password.</p>
        </div>
    </div>

    <div id="form2" class="hidden flex-col justify-center items-center w-full md:px-[10%] px-[5%] gap-10 mb-10">
        <div class="grid grid-cols-forgotpass justify-center items-center mt-[100px]" id="progress">
            <div class="bg-blue-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">1</p>
            </div>

            <div class="w-[80px] h-1 bg-blue-300">

            </div>

            <div class="bg-blue-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">2</p>
            </div>

            <div class="w-[80px] h-1 bg-gray-300">

            </div>

            <div class="bg-gray-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">3</p>
            </div>
        </div>

        <div class="shadow-2xl bg-white p-5 flex flex-col rounded-lg gap-6 w-full max-w-[500px] mt-[40px] justify-center mb-5">
            <h1 class="text-[25px] font-bold">Change Password</h1>
            <form class="flex flex-col gap-5" id="changepassword">
                <input class="p-3 outline-none rounded-lg bg-blue-50 w-full" type="text" name="pass" id="pass" placeholder="New Password">
                    <input class="p-3 outline-none rounded-lg bg-blue-50 w-full" type="text" name="vpass" id="vpass" placeholder="Verified New Password">
                    <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                            ring-blue-300 focus:outline-none focus:ring w-fit self-center" id="changepass">Save Password</button>
            </form>
        </div>

        <div>
            <p>1. Enter your desired new password in the designated field.</p>
            <p>2. Once you have entered your new password, re-enter it in the password verification field.</p>
            <p>3. The password verification field ensures that you have typed your new password correctly and helps prevent any typing errors.</p>
            <p>4. Once you are confident that the new password and its verification match, proceed to save password</p>
        </div>
    </div>

    <div id="form3" class="flex flex-col justify-center items-center w-full md:px-[10%] px-[5%]">
    <div class="grid grid-cols-forgotpass justify-center items-center mt-[100px]" id="progress">
            <div class="bg-blue-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">1</p>
            </div>

            <div class="w-[80px] h-1 bg-blue-300">

            </div>

            <div class="bg-blue-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">2</p>
            </div>

            <div class="w-[80px] h-1 bg-blue-300">

            </div>

            <div class="bg-blue-400 h-10 w-10 rounded-full flex justify-center items-center">
                <p class="text-white font-medium">3</p>
            </div>
        </div>

        <div class="shadow-2xl bg-white p-5 flex flex-col rounded-lg gap-6 w-full max-w-[500px] mt-[40px] justify-center mb-5">
            <h1 class="text-[25px] font-bold text-center">Your password has been changed successfully.</h1>
            <p>Please remember to keep your new password secure and confidential. If you have any further questions or need assistance with anything else, reach me on <a href="mailto: mrlonzanida08@gmail.com" class="text-blue-500">mrlonzanida08@gmail.com</a>.</p>
            <a href="../index.php" type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80 ring-blue-300 focus:outline-none focus:ring w-fit self-center" id="done">Sign in</a>
        </div>
    </div>

    <script>
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
            $("#loader").css('display', 'flex');
            var formData = $("#forgotpassword").serialize();

            if ($("#code").val() == "" || $("#studentid").val() == ""){
                $("#loader").hide();
                $("#successresponse").html("All fields are required");    
                $("#modalResponseSuccess").css('display', 'flex');
            }
            else{
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
            $("#loader").css('display', 'flex');
            var formData = $("#changepassword").serialize();

            if ($("#pass").val() == "" || $("#vpass").val() == ""){
                $("#loader").hide();
                $("#successresponse").html("All fields are required");
                $("#modalResponseSuccess").css('display', 'flex');
            }
            else{
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
    </script>
</body>
</html>