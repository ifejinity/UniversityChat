<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./dist/output.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>University Chat | Sign in</title>
</head>
<body class="bg-blue-50 md:h-screen h-full w-full overflow-x-hidden justify-center flex items-center">

    <!-- modal response -->
    <div id="modalResponse" class="fixed bg-black/30 w-full h-screen z-[10] justify-center items-center flex">
        <div class="w-[500px] h-fit bg-white rounded-lg p-5 flex flex-col justify-center items-center gap-5">
            <div id="response"></div>
            <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                ring-blue-300 focus:outline-none focus:ring w-fit" id="closeModal">Okay</button>
        </div>
    </div>

    <header class="bg-white py-4 grid grid-cols-header drop-shadow-lg items-center px-[5%] md:px-[10%] fixed top-0 w-full">
        <h1>Chat</h1>
        <div class="flex gap-4">
            <a href="./index.php" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring">Sign In</a>
            <a href="./pages/signup.php" class="p-3 rounded-lg hover:opacity-80">Sign Up</a>
        </div>
    </header>
    <!-- sign in form -->
    <div class="shadow-2xl bg-white p-5 flex flex-col rounded-lg gap-6 max-w-[500px] w-full mt-[100px] md:mx-[10%] mx-[5%]">
        <h1 class="text-[25px] font-bold">Sign in your account</h1>
        <form class="flex flex-col gap-5" id="signinForm">
            <input class="p-3 outline-none rounded-lg bg-blue-50" type="number" name="studentno" id="studentno" placeholder="Student Number">
            <input class="p-3 outline-none rounded-lg bg-blue-50" type="password" name="password" id="password" placeholder="Password">
            <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring" id="signin">Sign In</button>
        </form>
    </div>

    <script>
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
                        $("#modalResponse").show();
                        $("#response").html(`
                            <h1 class="font-bold text-[25px] text-center">Sign in Success!</h1>
                        `);
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
    </script>
</body>
</html>