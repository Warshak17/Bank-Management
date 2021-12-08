<?php
    if(isset($_POST['Sub'])){
        $name = $_POST['name'];
        $age = $_POST['age'];
        $pho = $_POST['pho'];
        $id = $_POST['id'];
        require 'connection.php';
        $query = "UPDATE admin SET NAME='$name',AGE='$age',PHO_NO='$pho' WHERE AD_ID='$id'";
        if(mysqli_query($conn,$query)){
            ?>
<html>
    <head>
        <script>
            alert("Details changed");
            window.location.replace("../editstaff.php");
        </script>
    </head>
</html>
            <?php
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Error while changing details");
            window.location.replace("../editstaff.php");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>