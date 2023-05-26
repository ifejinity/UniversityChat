<?php
    session_start();
    error_reporting(0);
    if($_SESSION["studentid"] != ""){
        header("location: ./pages/chat.php");
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
    <title>University Chat | Sign up</title>
</head>
<body class="bg-blue-50 md:h-screen h-full w-full overflow-x-hidden justify-center flex items-center">

    <!-- modal response -->
    <div id="modalResponse" class="fixed bg-black/30 w-full h-screen z-[10] justify-center items-center flex">
        <div class="w-[500px] h-fit bg-white rounded-lg p-5 flex flex-col justify-center items-center gap-5 md:mx-[10%] mx-[5%]">
            <div id="response"></div>
            <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                ring-blue-300 focus:outline-none focus:ring w-fit" id="closeModal">Okay</button>
        </div>
    </div>

    <header class="bg-white py-4 grid grid-cols-header drop-shadow-lg items-center px-[5%] md:px-[10%] fixed top-0 w-full">
        <h1>Logo</h1>
        <div class="flex gap-4">
            <a href="../index.php" class="p-3 rounded-lg hover:opacity-80">Sign In</a>
            <a href="./signup.php" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring">Sign Up</a>
        </div>
    </header>
    <!-- sign in form -->
    <div class="shadow-2xl bg-white p-5 flex flex-col rounded-lg gap-6 md:w-fit w-full mt-[100px] md:mx-[10%] mx-[5%]
    justify-center">
        <h1 class="text-[25px] font-bold">Sign up an account</h1>
        <form class="flex flex-col gap-5" id="signupForm">
            <div class="flex md:flex-row flex-col gap-5">
                <input class="p-3 outline-none rounded-lg bg-blue-50" type="text" name="fname" id="fname" placeholder="First Name" required>
                <input class="p-3 outline-none rounded-lg bg-blue-50" type="text" name="mname" id="mname" placeholder="Middle Name" required>
                <input class="p-3 outline-none rounded-lg bg-blue-50" type="text" name="lname" id="lname" placeholder="Last Name" required>
            </div>
            <div class="flex md:flex-row flex-col gap-5">
                <input class="p-3 outline-none rounded-lg bg-blue-50 md:w-1/2 w-full" type="number" name="studentno" id="studentno" placeholder="Student Number" required>
                <input class="p-3 outline-none rounded-lg bg-blue-50 md:w-1/2 w-full" type="number" name="contactno" id="contactno" placeholder="Contact Number" required>
            </div>
            <div class="flex md:flex-row flex-col gap-5">
                <input class="p-3 outline-none rounded-lg bg-blue-50 md:w-1/2 w-full" type="password" name="password" id="password" placeholder="Password" required>
                <input class="p-3 outline-none rounded-lg bg-blue-50 md:w-1/2 w-full" type="password" name="vpassword" id="vpassword" placeholder="Verify Password" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                ring-blue-300 focus:outline-none focus:ring w-[100px]" id="signup">Sign Up</button>
            </div>
        </form>
    </div>

    <script src="../js/signup.js"></script>
</body>
</html>