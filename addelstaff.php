<?php
    if(isset($_POST['Sub'])){
        $aid = $_POST['aid'];
        require 'connection.php';
        $query = "DELETE FROM admin WHERE AD_ID='$aid'";
        if(mysqli_query($conn,$query)){
            ?>
<html>
<head>
<script>
    alert("Deleted Admin!");
    window.location.replace("../delstaff.php");
</script>
</head>
</html>
            <?php
        }else{
            ?>
<html>
<head>
<script>
    alert("Error while deleting Admin!");
    window.location.replace("../delstaff.php");
</script>
</head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>