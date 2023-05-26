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

    <div class="bg-white w-full h-screen grid mx-[5%] md:mx-[10%] items-center max-w-[1440px] gap-5" id="holder">
        <div class="rounded-lg h-full w-full p-5 flex flex-col gap-5 pt-[100px] pb-[200px] overflow-y-scroll" id="conversation">
            <?php
            if($messages->num_rows > 0){
                while($rowmessages = $messages->fetch_assoc()){
                    if($studentid === $rowmessages["studentid"]){
            ?>
                        <div class="flex flex-col w-full" id="messageItem">
                            <h1 class="self-end text-[.9rem] text-gray-400"><?php echo $rowmessages["fullname"];?></h1>
                            <div class="self-end w-fit bg-blue-500 p-3 text-white rounded-full">
                                <h1><?php echo $rowmessages["message"] ?></h1>
                            </div>
                            <h1 class="self-end text-[.7rem] text-gray-400"><?php echo $rowmessages["datetime"];?></h1>
                        </div>
            <?php
                    }
                    else{
            ?>
                        <div class="flex flex-col w-full" id="messageItem">
                            <h1 class="self-start text-[.9rem] text-gray-400"><?php echo $rowmessages["fullname"];?></h1>
                            <div class="self-start w-fit bg-gray-300 p-3 rounded-full">
                                <h1><?php echo $rowmessages["message"]?></h1>
                            </div>
                            <h1 class="self-start text-[.7rem] text-gray-400"><?php echo $rowmessages["datetime"];?></h1>
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

    <div class="fixed w-full grid bottom-0 bg-white p-5 px-[5%] md:px-[10%] shadow-xl">
        <form id="myMessage" class="md:grid-cols-header grid-cols-1 gap-5 justify-center items-center grid">
            <input type="hidden" name="myLoaded2" value="10" id="limitdata2">
            <textarea class="outline-none bg-gray-200 p-5 rounded-lg resize-none"
            name="message" id="message" cols="30" rows="2" placeholder="Write a message"></textarea>
            <input type="hidden" name="studentid" value="<?php echo $studentid?>">
            <input type="hidden" name="fullname" value="<?php echo $fullname?>">
            <button type="submit" class="bg-blue-500 p-3 rounded-lg text-blue-50 hover:opacity-80
            ring-blue-300 focus:outline-none focus:ring w-[100px]" id="send">Send</button>
        </form>
    </div>
    <form id="limit">
        <input type="hidden" name="myLoaded" value="10" id="limitdata">
    </form>

    <script src="../js/chat.js"></script>
</body>
</html>