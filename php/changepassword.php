<?php
    include '../conn.php';
    session_start();

    $pass = $_POST["pass"];
    $vpass = $_POST["vpass"];
    $studentid = $_SESSION["changepassID"];

    $sql = "UPDATE user SET password = '$pass' WHERE studentid = '$studentid'";
    if($result = $conn->query($sql)){
        if($pass == $vpass){
            http_response_code(200);
            session_destroy();
        }
        else{
            http_response_code(500);
        }
    }
    else{
        http_response_code(500);
    }

    $conn->close();
?>