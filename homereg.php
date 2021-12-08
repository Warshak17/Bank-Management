<?php
    if(isset($_POST['Sub'])){
        ?>
<html>
    <head>
        <script>
            if(confirm("Please read and understand our terms and conditions. If you have read, click Ok and proceed.")){
                
            }else{
                window.location.replace("../home.html");
            }
        </script>
    </head>
</html>
        <?php
        $pin1 = $_POST['pin1'];
        $pin2 = $_POST['pin2'];
        if($pin1==$pin2){
            $pin = $pin1;
            if(strlen((string)$pin)==5){
                $pin = md5($pin);
                require 'connection.php';
                $name = $_POST['name'];
                $age = $_POST['age'];
                $add = $_POST['address'];
                $pho = $_POST['phono'];
                $email = $_POST['email'];
                $query = "INSERT INTO pending (NAME,PIN,AGE,ADDRESS,PHONO,EMAIL) VALUES('$name','$pin','$age','$add','$pho','$email')";
                if(mysqli_query($conn,$query)){
                    ?>
<html>
    <head>
        <script>
            alert("Successfully Registered! Wait for authentication");
            window.location.replace("../home.html");
        </script>
    </head>
</html>
                    <?php
                }else{
                    echo "Error";
                }
            }else{
                ?>
<html>
    <head>
        <script>
            alert("Pin is not 5 digits!");
            window.location.replace("../register.html");
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
            alert("Pin do not match!");
            window.location.replace("../register.html");
        </script>
    </head>
</html>
            <?php
        }
    }else{
        header("Location: ../home.html");
    }
?>