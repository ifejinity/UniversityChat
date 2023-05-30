<?php
    session_start();
    include '../conn.php';

    $code = $_POST["code"];
    $studentid = $_POST["studentid"];

    $sql = "SELECT * FROM forgot WHERE code = '$code' AND studentid = '$studentid'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION["changepassID"] = $studentid;
        http_response_code(200);
    }
    else{
        http_response_code(500);
    }

    $conn->close();
?>