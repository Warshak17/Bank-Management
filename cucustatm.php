<?php
    session_start();
    if(isset($_POST['atm'])){
        require 'connection.php';
        $id = $_SESSION['id'];
        $change = "APPLIED";
        $query = "UPDATE atmpass SET ATM='$change' WHERE CUST_ID='$id'";
        if(mysqli_query($conn,$query)){
            //sending mail
            $email = $_SESSION['email'];
            $name = $_SESSION['name'];
            $subject = "ATM Applied!";
            $body = "Hi ".$name.". Your request for ATM Card was approved. You will recieve the card shortly. Enjoy our services!";
            $headers = "From: bankmanagement.dbms@gmail.com";
            mail($email, $subject, $body, $headers);
            ?>
<html>
    <head>
        <script>
            alert("Successfully applied for ATM Card!");
            window.location.replace("../custatm.php");
        </script>
    </head>
</html>
            <?php
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Error while applying for ATM Card. Try again later!");
            window.location.replace("../custatm.php");
        </script>
    </head>
</html>
            <?php
        }
    }elseif(isset($_POST['pass'])){
        require 'connection.php';
        $id = $_SESSION['id'];
        $change = "APPLIED";
        $query = "UPDATE atmpass SET PASSBOOK='$change' WHERE CUST_ID='$id'";
        if(mysqli_query($conn,$query)){
            $namefortable = $id."pass";
            $query = "CREATE TABLE $namefortable(
                ID int(10) NOT NULL AUTO_INCREMENT,
                CUST_ID varchar(10) NOT NULL,
                TYPE varchar(10) NOT NULL,
                AMOUNT int(10) NOT NULL,
                BALANCE int(10) NOT NULL,
                TIME timestamp(6) NOT NULL DEFAULT current_timestamp(6),
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
            mysqli_query($conn,$query);
            $query = "SELECT * FROM transaction WHERE CUST_ID='$id'";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                $ttype = $row['TYPE'];
                $tamo = $row['AMOUNT'];
                $tbal = $row['BALANCE'];
                $ttime = $row['TIME'];
                $query = "INSERT INTO $namefortable (CUST_ID,TYPE,AMOUNT,BALANCE,TIME) 
                VALUES ('$id','$ttype','$tamo','$tbal','$ttime')";
                mysqli_query($conn,$query);
            }
            $_SESSION['pass'] = "Pass";
            $email = $_SESSION['email'];
            $name = $_SESSION['name'];
            $subject = "PASSBOOK Applied!";
            $body = "Hi ".$name.". Your request for PassBook was approved. You will recieve the book shortly. Enjoy our services!";
            $headers = "From: bankmanagement.dbms@gmail.com";
            mail($email, $subject, $body, $headers);
            ?>
<html>
    <head>
        <script>
            alert("Successfully applied for PASSBOOK!");
            window.location.replace("../custatm.php");
        </script>
    </head>
</html>
            <?php
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Error while applying for PASSBOOK. Try again later!");
            window.location.replace("../custatm.php");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>