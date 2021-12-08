<?php
    
    $email = $_POST['email'];
    $subject = "Sample";
    $body = "Hey";
    $headers = "From: bankmanagement.dbms@gmail.com";
    if (mail($email, $subject, $body, $headers)) {
        echo "Email successfully sent to $email...";
    }else{
    echo "Email sending failed...";
    }
?>