<?php
    include '../conn.php';
    session_start();

    if($_SESSION["studentid"] == "" || $_SESSION["studentid"] == null){
        header("location: ../index.php");
    }

    $studentid = $_SESSION["studentid"];

    $selectInfo = "SELECT * FROM user WHERE studentid = '$studentid'";
    $result = $conn->query($selectInfo);
    while($row = $result->fetch_assoc()){
        $fullname = $row["fname"] . " " . $row["mname"] . " " . $row["lname"];
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
    <title>University Chat</title>
</head>
<body class="bg-blue-50 h-screen w-full overflow-x-hidden justify-center flex items-center">
    
    <!-- modal sign out -->
    <div id="modalSignout" class="fixed bg-black/30 w-full h-screen z-[10] justify-center items-center flex">
        <div class="w-[500px] h-fit bg-white rounded-lg p-5 flex flex-col justify-center items-center gap-5 md:mx-[10%] mx-[5%]">
            <div>
                <h1 class="text-[25px] font-bold">Are you sure?</h1>
            </div>
            <div class="flex flex-row gap-5">
                <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                    ring-blue-300 focus:outline-none focus:ring w-[100px]" id="proceed">Yes</button>
                <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                    ring-blue-300 focus:outline-none focus:ring w-[100px]" id="cancel">Cancel</button>
            </div>
        </div>
    </div>

    <header class="bg-white py-4 grid grid-cols-header drop-shadow-lg items-center px-[5%] md:px-[10%] fixed top-0 w-full">
        <h1>Logo</h1>
        <div class="flex gap-4">
            <button class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring" id="signout">Sign out</button>
        </div>
    </header>

    <h1><?php echo $fullname ?></h1>

    <script>
        $("#modalSignout").hide();
        $("#signout").click(()=>{
            $("#modalSignout").show();
        })

        $("#cancel").click(()=>{
            $("#modalSignout").hide();
        })

        $(document).ready(()=> {   
            $("#proceed").click((e)=>{
                e.preventDefault(); // Prevent the form from submitting normally

                $.ajax({
                    url: '../php/signout.php',
                    success: function(response){
                        window.location.href = '../index.php';
                    }
                });
            });
        });
    </script>
</body>
</html>