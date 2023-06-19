<?php
    include '../conn.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    $studentid = $_POST["studentid"];

    $sql = "SELECT * from user WHERE studentid = '$studentid'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $email = $row["email"];
        }

        $code = rand(100000, 999999);

        $sql3 = "SELECT * FROM forgot WHERE studentid = '$studentid'";
        $result3 = $conn->query($sql3);
        
        if($result3->num_rows > 0){
            $sql2 = "UPDATE forgot SET code='$code' WHERE studentid = '$studentid'";
        }
        else{
            $sql2 = "INSERT INTO forgot (code, studentid) VALUES ($code, $studentid)";
        }

        if($result2 = $conn->query($sql2)){
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
            $mail->addAddress($email);
            $mail->Subject = ("UniversityChat");
            $mail->Body = "Your reset password code is $code";
            $mail->send();
        }
    }
    else{
        http_response_code(500);
    }

    $conn->close();
?>  
