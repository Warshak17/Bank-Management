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
            <?php include 'customernav.php'; ?>
            <div class="content">
                <div class="smallbox" style="margin-top: 5%;">
                    <?php
                        require 'server/connection.php';
                        $query = "SELECT * FROM customer WHERE CUST_ID='$id'";
                        $results = mysqli_query($conn,$query);
                        $row = mysqli_fetch_assoc($results);
                        $aid = $row['AD_ID'];
                        $name = $row['NAME'];
                        $pin = $row['PIN'];
                        $add = $row['ADDRESS'];
                        $age = $row['AGE'];
                        $bal = $row['BALANCE'];
                        $pho = $row['PHO'];
                        $last= $row['LAST_LOGIN'];
                    ?>
                    <p id="heading">Personal Details</p>
                    <table>
                        <tr><td>Customer ID: </td><td><input type="text" value="<?php echo $id ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Customer Name: </td><td><input type="text" value="<?php echo $name ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Admin approved: </td><td><input type="text" value="<?php echo $aid ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Pin: </td><td><input type="password" value="<?php echo $pin ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Age: </td><td><input type="text" value="<?php echo $age ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Address: </td><td><input type="text" value="<?php echo $add ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Balance: </td><td><input type="text" value="<?php echo $bal ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Phone Number: </td><td><input type="text" value="<?php echo $pho ?>" style="text-align:center;width:130px" readonly></td></tr>
                        <tr><td>Last Login: </td><td><input type="text" value="<?php echo $last ?>" style="text-align:center;width:130px" readonly></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>