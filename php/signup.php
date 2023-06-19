<?php
    include '../conn.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    $studentid  = $_POST["studentno"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mname = $_POST["mname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $vpassword = $_POST["vpassword"];

    if($password === $vpassword){
        $sql = "INSERT INTO user (studentid, fname, lname, mname, email, password)
        VALUES ('$studentid', '$fname', '$lname', '$mname', '$email', '$password')";
        if($conn->query($sql) === true){
            http_response_code(200);
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mrlonzanida08@gmail.com';
            $mail->Password = '';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->isHTML(true);
            $mail->setFrom('mrlonzanida08@gmail.com');
            $name = $fname . " " . $mname . " " . $lname;
            $mail->addAddress($email, $name);
            $mail->Subject = ("UniversityChat");
            $mail->Body = "Thank you $name for successfully signing up on University Chat.";
            $mail->send();
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
