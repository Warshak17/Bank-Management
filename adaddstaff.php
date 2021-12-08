<?php
    if(isset($_POST['Sub'])){
        $name = $_POST['name'];
        $id = $_POST['id'];
        $pin = $_POST['pin'];
        $pho = $_POST['pho'];
        $age = $_POST['age'];
        $pin = md5($pin);
        require 'connection.php';
        $query = "INSERT INTO admin (AD_ID,NAME,PIN,PHO_NO,AGE) VALUES('$id','$name','$pin','$pho','$age')";
        if(mysqli_query($conn,$query)){
            ?>
<html>
    <head>
        <script>
            alert("Staff added!");
            window.location.replace("../admin.php");
        </script>
    </head>
</html>
            <?php
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Error while inserting!");
            window.location.replace("../admin.php");
        </script>
    </head>
</html>
            <?php 
        }
    }else{
        header("Location: ../home.html");
    }
?>