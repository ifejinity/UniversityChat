<?php
    session_start();
    include '../conn.php';
    $limit = $_POST["myLoaded"];
    $studentid = $_SESSION["studentid"];
    $selectMessages = "SELECT * FROM (SELECT * FROM messages ORDER BY messageid DESC LIMIT $limit) AS subquery ORDER BY messageid ASC";
    $messages = $conn->query($selectMessages);

    if($messages->num_rows > 0){
        while ($rowmessages = $messages->fetch_assoc()) {
            $message =  $rowmessages["message"];
            $datetime =  $rowmessages["datetime"];
            $fname =  $rowmessages["fullname"];

            if ($studentid === $rowmessages["studentid"]) {
                echo "
                    <div class='flex flex-col w-full' id='messageItem'>
                        <h1 class='self-end text-[.9rem] text-gray-400'>$fname</h1>
                        <div class='chat chat-end'>
                            <div class='chat-bubble bg-blue-500'>
                                <h1 class='text-white'>$message</h1>
                            </div>
                        </div>
                        <h1 class='self-end text-[.7rem] text-gray-400'>$datetime</h1>
                    </div>
                ";
            } else {
                echo "
                    <div class='flex flex-col w-full' id='messageItem'>
                        <h1 class='self-start text-[.9rem] text-gray-400'>$fname</h1>
                        <div class='chat chat-start'>
                            <div class='chat-bubble bg-gray-200'>
                                <h1 class='text-black'>$message</h1>
                            </div>
                         </div>
                        <h1 class='self-start text-[.7rem] text-gray-400'>$datetime</h1>
                    </div>
                ";
            }
        }
    }
    else{
        echo "<h1 class='text-[30px] font-bold text-blue-500 text-center'>No messages</h1>";
    }
    $conn->close();
?>
