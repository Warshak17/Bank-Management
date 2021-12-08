<?php
    session_start();
    if(isset($_POST['Sub'])){
        $id = $_SESSION['id'];
        $name = $_POST['name'];     //who to transfer
        $bal = $_POST['bal'];       //balance who transfer 
        $amount = $_POST['amount']; //amount transferring
        $final = $bal - $amount;
        if($amount>$bal){
            ?>
<html>
    <head>
        <script>
            alert("Transferring amount exceeds your balance. Try with lesser amount..");
            window.location.replace("../custfind.php");
        </script>
    </head>
</html>
            <?php
        }elseif($final<1000){
            ?>
<html>
    <head>
        <script>
            alert("Balance will be lesser than minimum balance! Try with lesser amount..");
            window.location.replace("../custfund.php");
        </script>
    </head>
</html>
            <?php
        }else{
            $type = "TRANSFER";
            require 'connection.php';
            //sending mail to who sent
            $email = $_SESSION['email'];
            $cname = $_SESSION['name'];
            $subject = "Amount Transfered!";
            $body = "Hi ".$cname.". You have sent ".$amount." to ".$name.".\nYour balance now is: ".$final.". If its not you, kindly report to our staffs!";
            $headers = "From: bankmanagement.dbms@gmail.com";
            mail($email, $subject, $body, $headers);
            //insert into transaction
            $query = "INSERT INTO transaction (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amount','$final')";
            mysqli_query($conn,$query);
            //insert into passbook;
            if(isset($_SESSION['pass'])){
                $namefortable = $id."pass";
                $query = "INSERT INTO $namefortable (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amount','$final')";
                mysqli_query($conn,$query);
            }
            // get to id, to balance;
            $query = "SELECT CUST_ID,BALANCE,EMAIL FROM customer WHERE NAME='$name'";
            $results = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($results);
            $balance = $row['BALANCE'];
            $id = $row['CUST_ID'];
            $email = $row['EMAIL'];
            $final = $balance + $amount;
            //sending mail to reciever
            $cname = $_SESSION['name'];
            $subject = "Amount Recieved!";
            $body = "Hi ".$name.". Your account has been credited with ".$amount." from .".$cname."\nYour balance now is: ".$final;
            $headers = "From: bankmanagement.dbms@gmail.com";
            mail($email, $subject, $body, $headers);
            //insert into transaction
            $query = "INSERT INTO transaction (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amount','$final')";
            mysqli_query($conn,$query);
            ?>
<html>
    <head>
        <script>
            alert("Amount transferred!");
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