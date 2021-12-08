<?php
    session_start();
    if(isset($_SESSION['name'])){
        $id = $_SESSION['id'];
        require 'server/connection.php';
        $query = "SELECT * FROM transaction WHERE CUST_ID='$id'";
        $results = mysqli_query($conn,$query);
    }else{
        header("Location: home.html");
    }
?>
<html>
    <head> 
        <title>Welcome <?php echo $_SESSION['name'] ?></title>
        <link rel="stylesheet" href="css/customer.css">
    </head>
    <body>
        <div class="header">
            <img src="css/header.jpg" alt="Header img">
            <ul>
                <li><a href="customer.php">Home</a></li>
                <?php
                    require 'server/connection.php';
                    $query = "SELECT PASSBOOK FROM atmpass WHERE CUST_ID='$id'";
                    $result = mysqli_query($conn,$query);
                    $row = mysqli_fetch_assoc($result);
                    $pass = $row['PASSBOOK'];
                    if($pass=="APPLIED"){
                        ?>
                            <li><a href="custpass.php">Pass book</a></li>
                        <?php
                    }
                ?>
                <li><a href="server/logout.php">Logout</a></li>
                <?php
                    if($pass=="APPLIED"){
                        ?>
                        <li><a href="" style="padding:10px 485px;"></a></li>
                        <?php
                    }else{
                        ?>
                            <li><a href="" style="padding:10px 537px;"></a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <div class="container">
            <?php include 'customernav.php'; ?>
            <div class="content">
                <div class="smallbox">
                    <p id="heading">Change Pin Number</p>
                    <form action="server/cucustpinchange.php" method="POST">
                    <table>
                        <tr><td>Enter new pin: </td><td><input type="password" name="pin1"></td></tr>
                        <tr><td>Confim new pin: </td><td><input type="password" name="pin2"></td></tr>
                        <tr><td colspan="2" style="text-align:center;"><input type="submit" value="Change pin" name="Sub"></td></tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>