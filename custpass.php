<?php
    session_start();
    if(isset($_SESSION['name'])){
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $name = $id."pass";
        require 'server/connection.php';
        $query = "SELECT * FROM $name WHERE CUST_ID='$id'";
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
                <div class="smallbox" style="margin-top: 5%; margin-left: 10%; max-height: 250px; overflow:auto;">
                   <?php
                    if(mysqli_num_rows($results)==0){
                        ?>
                        <p id="heading">Passbook Details</p>
                        <p>Passbook is empty!</p>
                        <?php
                    }else{
                        ?>
                        <table>
                        <p id="heading">Passbook Details</p>
                        <tr><th>CUST_ID</th><th>TYPE</th><th>AMOUNT</th><th>BALANCE</th><th>TIME</th></tr>
                        <?php
                        while($row = mysqli_fetch_assoc($results)){
                            $type = $row['TYPE'];
                            $amount = $row['AMOUNT'];
                            $bal = $row['BALANCE'];
                            $time = $row['TIME'];
                            ?>
                            <tr><td><input type="text" value="<?php echo $id ?>" style="text-align:center;width:130px" readonly></td>
                            <td><input type="text" value="<?php echo $type ?>" style="text-align:center;width:130px" readonly></td>
                            <td><input type="text" value="<?php echo $amount ?>" style="text-align:center;width:130px" readonly></td>
                            <td><input type="text" value="<?php echo $bal ?>" style="text-align:center;width:130px" readonly></td>
                            <td><input type="text" value="<?php echo $time ?>" style="text-align:center;width:130px" readonly></td></tr>
                            <?php
                        }
                        ?>
                        </table>
                        <?php
                    }
                   ?>
                </div>
            </div>
        </div>
    </body>
</html>