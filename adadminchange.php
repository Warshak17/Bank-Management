<?php
    session_start();
    if(isset($_POST['Sub'])){
        $id = $_SESSION['id'];
        $pin1 = $_POST['pin1'];
        $pin2 = $_POST['pin2'];
        if($pin1==$pin2){
            if(strlen((string)$pin1)==5){
                $pin = md5($pin1);
                require 'connection.php';
                $query = "UPDATE admin SET PIN='$pin' WHERE AD_ID='$id'";
                if(mysqli_query($conn,$query)){
                    ?>
<html>
    <head>
        <script>
            alert("Pin is successfully changed.");
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
            alert("Error while changing pin!");
            window.location.replace("../admin.php");
        </script>
    </head>
</html>
                    <?php
                }
            }else{
                ?>
<html>
    <head>
        <script>
            alert("Pin is not 5 digits! Try again");
            window.location.replace("../adminchange.php");
        </script>
    </head>
</html>
                <?php
            }
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Pin do not match! Try again");
            window.location.replace("../adminchange.php");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>