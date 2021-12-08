<?php
    session_start();
    if(isset($_POST['Sub'])){
        $pin = $_POST['pin'];
        $id = $_POST['id'];
        if(strlen((string)$pin)==5){
            $pin = md5($pin);
            require 'connection.php';
            if($id[0]=='A'){
                $query = "SELECT * FROM admin WHERE AD_ID='$id'";
                $results = mysqli_query($conn,$query);
                if(mysqli_num_rows($results)==0){
                    ?>
<html>
    <head>
        <script>
            alert("No such user");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
                    <?php
                }else{
                    while($row = mysqli_fetch_assoc($results)){
                        $pinc = $row['PIN'];
                        $name = $row['NAME'];
                        $aid = $row['AD_ID'];
                    }
                    if($pin==$pinc){
                        $_SESSION['name'] = $name;
                        $_SESSION['id'] = $aid;
                        $_SESSION['type'] = "admin";
                        header("Location: ../admin.php");
                    }else{
                        ?>
<html>
    <head>
        <script>
            alert("Login credentials is incorrect");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
                        <?php
                    }
                }
            }else{          //customer
                $query = "SELECT * FROM customer WHERE CUST_ID='$id'";
                $results = mysqli_query($conn,$query);
                if(mysqli_num_rows($results)==0){
                    ?>
<html>
    <head>
        <script>
            alert("No such user");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
                    <?php
                }else{      
                    while($row = mysqli_fetch_assoc($results)){
                        $pinc = $row['PIN'];
                        $name = $row['NAME'];
                        $cid = $row['CUST_ID'];
                        $email = $row['EMAIL'];
                    }
                    if($pin==$pinc){
                        $_SESSION['name'] = $name;
                        $_SESSION['id'] = $cid;
                        $_SESSION['type'] = "customer";
                        $_SESSION['email'] = $email;
                        header("Location: ../customer.php");
                    }else{
                        ?>
<html>
    <head>
        <script>
            alert("Login credentials is incorrect");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
                        <?php
                    }
                }
            }
        }else{
            ?>
<html>
    <head>
        <script>
            alert("Pin is not 5 digits! Try again");
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