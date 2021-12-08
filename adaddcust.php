<?php
    if(isset($_POST['Sub'])){
        $name = $_POST['name'];
        $cid = $_POST['cid'];
        $aid = $_POST['aid'];
        $pin = $_POST['pin'];
        $age = $_POST['age'];
        $add = $_POST['add'];
        $bal = $_POST['bal'];
        $pho = $_POST['pho'];
        //sending email   
        $email = $_POST['email'];
        $subject = "Registered Successfully";
        $body = "Hi ".$name.". You have been approved by ".$aid.".\nYour Customer id: ".$cid."\nYour balance: ".$bal."\nThanks for choosing our service!";
        $headers = "From: bankmanagement.dbms@gmail.com";
    if (mail($email, $subject, $body, $headers)) {
        echo "Email successfully sent to $email...";
    }else{
    echo "Email sending failed...";
    }
        require 'connection.php';
        $query = "INSERT INTO customer(CUST_ID,AD_ID,NAME,PIN,AGE,ADDRESS,BALANCE,PHO,EMAIL) VALUES('$cid','$aid','$name','$pin','$age','$add','$bal','$pho','$email')";
        if(mysqli_query($conn,$query)){
            ?>
<html>
    <head>
        <script>
            alert("Customer addded");
            window.location.replace("../addcust.php");
        </script>
    </head>
</html>
            <?php
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Error adding");
            window.location.replace("../addcust.php");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>