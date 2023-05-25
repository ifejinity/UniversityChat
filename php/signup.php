<?php
    include '../conn.php';
    $studentid  = $_POST["studentno"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mname = $_POST["mname"];
    $cnumber = $_POST["contactno"];
    $password = $_POST["password"];
    $vpassword = $_POST["vpassword"];

    if($password === $vpassword){
        $sql = "INSERT INTO user (studentid, fname, lname, mname, cnumber, password)
        VALUES ('$studentid', '$fname', '$lname', '$mname', '$cnumber', '$password')";
        if($conn->query($sql) === true){
            http_response_code(200);
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