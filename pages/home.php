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

    $selectMessages = "SELECT * FROM (SELECT * FROM messages ORDER BY messageid DESC LIMIT 10) AS subquery ORDER BY messageid ASC";
    $messages = $conn->query($selectMessages);
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
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.0/dist/full.css" rel="stylesheet" type="text/css" />
    <title>University Chat</title>
</head>
<body class="bg-blue-50 h-screen w-full overflow-x-hidden justify-center flex items-center font-outfit">
     <!-- loader -->
     <div class="fixed bg-white/80 w-full h-screen hidden justify-center items-center z-[1] flex-col gap-20" id="loader">
        <div class="relative">
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
            <div class="loader">
                <div class="dot"></div>
            </div>
        </div>
        <div>
            <h1 class="text-[1rem]">Please wait</h1>
        </div>
    </div>

    <!-- modal sign out -->
    <div id="modalSignout" class="fixed bg-black/30 w-full h-screen z-[10] justify-center items-center hidden">
        <div class="w-fit h-fit bg-white rounded-lg p-5 flex flex-col justify-center items-center gap-5 md:mx-[10%] mx-[5%]">
            <div>
                <h1 class="text-[20px] font-bold">Are you sure?</h1>
            </div>
            <div class="flex flex-row gap-5">
                <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                    ring-blue-300 focus:outline-none focus:ring w-[100px]" id="proceed">Yes</button>
                <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
                    ring-blue-300 focus:outline-none focus:ring w-[100px]" id="cancel">Cancel</button>
            </div>
        </div>
    </div>

    <header class="bg-white py-4 grid grid-cols-header drop-shadow-lg items-center px-[5%] md:px-[10%] fixed top-0 w-full z-[1]">
        <img class="w-[45px]" src="../src/resources/logo.png" alt="" srcset="">
        <div class="flex gap-4">
            <button class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring" id="signout">Sign out</button>
        </div>
    </header>

    <div class="bg-white w-full h-screen grid mx-[5%] md:mx-[10%] items-center max-w-[1440px] gap-5" id="holder">
        <div class="rounded-lg h-full w-full p-5 flex flex-col gap-5 pt-[100px] pb-[200px] overflow-y-scroll" id="conversation">
            <?php
            if($messages->num_rows > 0){
                while($rowmessages = $messages->fetch_assoc()){
                    if($studentid === $rowmessages["studentid"]){
            ?>
                        <div class="flex flex-col w-full" id="messageItem">
                            <h1 class="self-end text-[.9rem] text-gray-400"><?php echo $rowmessages["fullname"];?></h1>
                            <div class="chat chat-end">
                                <div class="chat-bubble bg-blue-500">
                                    <h1 class="text-white"><?php echo $rowmessages["message"] ?></h1>
                                </div>
                            </div>
                            <h1 class="self-end text-[.7rem] text-gray-400" id="msgdate"><?php echo $rowmessages["datetime"];?></h1>
                        </div>
            <?php
                    }
                    else{
            ?>          
                        <div class="flex flex-col w-full" id="messageItem">
                            <h1 class="self-start text-[.9rem] text-gray-400"><?php echo $rowmessages["fullname"];?></h1>
                            <div class="chat chat-start">
                                <div class="chat-bubble bg-gray-200">
                                    <h1 class="text-black"><?php echo $rowmessages["message"]?></h1>
                                </div>
                            </div>
                            <h1 class="self-start text-[.7rem] text-gray-400" id="msgdate"><?php echo $rowmessages["datetime"];?></h1>
                        </div>
            <?php
                    }
                }
            }
            else
            {
            ?>
                <h1 class="text-[30px] font-bold text-blue-500 text-center">No messages</h1>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="fixed w-full grid bottom-0 bg-white sm:p-5 p-3 px-[5%] md:px-[10%] shadow-xl">
        <form id="myMessage" class="grid-cols-header gap-2 sm:gap-5 justify-center items-center grid">
            <input type="hidden" name="myLoaded2" value="10" id="limitdata2">
            <textarea class="outline-none bg-gray-200 p-5 rounded-lg resize-none"
            name="message" id="message" cols="1" rows="2" placeholder="Write a message"></textarea>
            <input type="hidden" name="studentid" value="<?php echo $studentid?>">
            <input type="hidden" name="fullname" value="<?php echo $fullname?>">
            <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring w-fit" id="send">Send</button>
        </form>
    </div>
    <form id="limit">
        <input type="hidden" name="myLoaded" value="10" id="limitdata">
    </form>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/home.js"></script>
</body>
</html>