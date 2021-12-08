<?php
    session_start();
    if(isset($_SESSION['name'])){
        require 'connection.php';
        $name = $_SESSION['name'];
        $type = $_SESSION['type'];
        if($type=="admin"){
            $query = "UPDATE admin SET LAST_LOGIN=current_timestamp WHERE NAME='$name'";
            mysqli_query($conn,$query);
            session_abort();
            ?>
<html>
    <head>
        <script>
            alert("Successfully logged out!");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
            <?php
        }else{      //customer
            $query = "UPDATE customer SET LAST_LOGIN=current_timestamp WHERE NAME='$name'";
            mysqli_query($conn,$query);
            session_abort();
            ?>
<html>
    <head>
        <script>
            alert("Successfully logged out!");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>