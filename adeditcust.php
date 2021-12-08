<?php
    if(isset($_POST['Sub'])){
        $name = $_POST['name'];
        $age = $_POST['age'];
        $pho = $_POST['pho'];
        $add = $_POST['add'];
        $id = $_POST['id'];
        require 'connection.php';
        $query = "UPDATE customer SET NAME='$name',AGE='$age',PHO='$pho',ADDRESS='$add' WHERE CUST_ID='$id'";
        if(mysqli_query($conn,$query)){
            ?>
<html>
    <head>
        <script>
            alert("Details changed");
            window.location.replace("../editcust.php");
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
            window.location.replace("../editcust.php");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>