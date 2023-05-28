<?php
    include '../conn.php';
    session_start();

    $studentno = $_POST["studentno"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE password = '$password' AND studentid = '$studentno'";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM user WHERE password = '$password' AND studentid = '$studentno'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        $_SESSION["studentid"] = $studentno;
        http_response_code(200);
    }
    else{
        http_response_code(500);
    }

    $conn->close();
?>