<?php
    include '../conn.php';
    $limit = $_POST["myLoaded2"];
    $studentid = $_POST["studentid"];
    $fullname = $_POST["fullname"];
    $message = $_POST["message"];
    $mydate = getdate(date("U"));
    $datetoday = "$mydate[month] $mydate[mday], $mydate[year]";

    $sql = "INSERT INTO messages (studentid, fullname, message, datetime) VALUES
            ('$studentid', '$fullname', '$message', '$datetoday')";

    if ($result = $conn->query($sql)) {
        $selectMessages = "SELECT * FROM (SELECT * FROM messages ORDER BY messageid DESC LIMIT $limit) AS subquery ORDER BY messageid ASC";
        $messages = $conn->query($selectMessages);

        while ($rowmessages = $messages->fetch_assoc()) {
            $message =  $rowmessages["message"];
            $datetime =  $rowmessages["datetime"];
            $fname =  $rowmessages["fullname"];

            if ($studentid === $rowmessages["studentid"]) {
                echo "
                    <div class='flex flex-col w-full' id='messageItem'>
                        <h1 class='self-end text-[.9rem] text-gray-400'>$fname</h1>
                        <div class='self-end w-fit bg-blue-500 p-3 text-white rounded-full'>
                            <h1>$message</h1>
                        </div>
                        <h1 class='self-end text-[.7rem] text-gray-400'>$datetime</h1>
                    </div>
                ";
            } else {
                echo "
                    <div class='flex flex-col w-full' id='messageItem'>
                        <h1 class='self-start text-[.9rem] text-gray-400'>$fname</h1>
                        <div class='self-start w-fit bg-gray-300 p-3 rounded-full'>
                            <h1>$message</h1>
                        </div>
                        <h1 class='self-start text-[.7rem] text-gray-400'>$datetime</h1>
                    </div>
                ";
            }
        }
    } else {
        http_response_code(500);
    }
    $conn->close();
?>
