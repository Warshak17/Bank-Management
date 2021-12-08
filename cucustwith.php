<?php
    session_start();
    if(isset($_POST['Sub'])){
        $id = $_SESSION['id'];
        $bal = $_POST['bal'];
        $amo = $_POST['with'];
        if($amo>$bal||($bal-$amo)<1000){
            ?>
<html>
    <head>
        <script>
            alert("Withdrawing amount is greater than your balance/minimum balance. Try with lesser amount...");
            window.location.replace("../custwith.php");
        </script>
    </head>
</html>
            <?php
        }else{
            $final = $bal - $amo;
            $type = "WITHDRAW";
            require 'connection.php';
            //sending mail
            $email = $_SESSION['email'];
            $cname = $_SESSION['name'];
            $subject = "Amount withdrawn!";
            $body = "Hi ".$cname.". You have withdrawed ".$amo."\nYour balance now is: ".$final.".\nIf its not you, kindly report to our staffs!";
            $headers = "From: bankmanagement.dbms@gmail.com";
            mail($email, $subject, $body, $headers);
            $query = "INSERT INTO transaction (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amo','$final')";
            if(mysqli_query($conn,$query)){
                if(isset($_SESSION['pass'])){
                    $namefortable = $id."pass";
                    $query = "INSERT INTO $namefortable (CUST_ID,TYPE,AMOUNT,BALANCE) VALUES ('$id','$type','$amo','$final')";
                    mysqli_query($conn,$query);
                }
                ?>
<html>
    <head>
        <script>
            alert("Successfully withdrawn!");
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
            alert("Error while withdrawing");
            window.location.replace("../customer.php");
        </script>
    </head>
</html>
                <?php
            }
        }
    }else{
        header("Location: ../home.html");
    }
?>