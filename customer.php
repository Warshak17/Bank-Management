<?php
    session_start();
    if(isset($_SESSION['name'])){
        require 'server/connection.php';
        $id = $_SESSION['id'];
        $query = "SELECT * FROM customer WHERE CUST_ID='$id'";
        $results = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($results);
        $aid = $row['AD_ID'];
        $bal = $row['BALANCE'];
        $lastlog = $row['LAST_LOGIN'];
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
                        $_SESSION['pass'] = "Pass";
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
            <div class="left">
                <table>
                    <tr><td>Account ID: </td><td><?php echo $id ?></td></tr>
                    <tr><td>Admin Approved: </td><td><?php echo $aid ?></td></tr>
                </table>
            </div>
            <div class="right">
                <table>
                    <tr><td>Balance: </td><td><?php echo $bal ?></td></tr>
                    <tr><td>Last Login: </td><td><?php echo $lastlog ?></td></tr>
                </table>
            </div>
        </div>
    </body>
</html>