<?php
    session_start();
    if(isset($_SESSION['name'])){
        $id = $_SESSION['id'];
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
            <?php 
                include 'customernav.php'; 
                require 'server/connection.php';
                $query = "SELECT * FROM atmpass WHERE CUST_ID='$id'";
                $results = mysqli_query($conn,$query);
                $row = mysqli_fetch_assoc($results);
                $atm = $row['ATM'];
                $pass= $row['PASSBOOK'];
            ?>
            <div class="content">
                <div class="smallbox" style="margin-left:30%;margin-top:10%;">
                    <p id="heading">Request for ATM/Pass book</p>
                    <table>
                        <tr><td>ATM Card: </td><td><?php echo $atm ?></td></tr>
                        <tr><td>Pass Book: </td><td><?php echo $pass ?></td></tr>
                        <form method="POST" action="server/cucustatm.php">
                        <?php
                            if($atm=="PENDING"&&$pass=="PENDING"){
                                ?>
                                    <tr><td><input type="submit" name="atm" value="Apply ATM" style="width:100%"></td><td><input type="submit" name="pass" value="Apply Passbook" style="width:100%"></td></tr>
                                <?php
                            }elseif($atm=="PENDING"){
                                ?>
                                    <tr><td colspan="2" style="text-align:center;"><input type="submit" name="atm" value="Apply ATM" style="width:100%"></td></tr>
                                <?php
                            }elseif($pass=="PENDING"){
                                ?>
                                    <tr><td colspan="2" style="text-align:center;"><input type="submit" name="pass" value="Apply Passbook" style="width:100%"></td></tr>
                                <?php
                            }
                        ?>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>