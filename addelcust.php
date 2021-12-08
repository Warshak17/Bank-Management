<?php
    if(isset($_POST['Sub'])){
        $cid = $_POST['cid'];
        $name = $_POST['name'];
        $aid = $_POST['aid'];
        require 'connection.php';
        $query = "DELETE FROM customer WHERE CUST_ID='$cid'";
        if(mysqli_query($conn,$query)){
            //sending mail
            $email = $_POST['email'];
            $subject = "User deleted!";
            $body = "Hi ".$name.". Your account has been deleted by Admin no. ".$aid.". So no longer can access our service. Thanks for using our service!";
            $headers = "From: bankmanagement.dbms@gmail.com";
        if (mail($email, $subject, $body, $headers)) {
            echo "Email successfully sent to $email...";
        }else{
            echo "Email sending failed...";
        }
            ?>
<html>
<head>
<script>
    alert("Deleted Customer!");
    window.location.replace("../delcust.php");
</script>
</head>
</html>
            <?php
        }else{
            ?>
<html>
<head>
<script>
    alert("Error while deleting customer!");
    window.location.replace("../delcust.php");
</script>
</head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>