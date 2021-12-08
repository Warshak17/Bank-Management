<?php
    session_start();
    if(isset($_POST['Sub'])){
        $amount = $_POST['amount'];
        $bal = $_POST['bal'];
        $final = $amount + $bal;
        $id = $_SESSION['id'];
        $type = "CREDIT";
        require 'connection.php';
        $query = "INSERT INTO transaction (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amount','$final')";
        if(mysqli_query($conn,$query)){
            if(isset($_SESSION['pass'])){
                $namefortable = $id."pass";
                $query = "INSERT INTO $namefortable (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amount','$final')";
                mysqli_query($conn,$query);
            }
            $email = $_SESSION['email'];
            $cname = $_SESSION['name'];
            $subject = "Amount Credited!";
            $body = "Hi ".$cname.". Your account have been credited with ".$amount."\nYour balance now is: ".$final;
            $headers = "From: bankmanagement.dbms@gmail.com";
            mail($email, $subject, $body, $headers);
            ?>
<html>
    <head>
        <script>
            alert("Amount Deposited. Returning to home page...");
            window.location.replace("../customer.php");
        </script>
    </head>
</html>
            <?php
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Error in depositing amount!");
            window.location.replace("../customer.php");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>