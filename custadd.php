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
                <?php
                    require 'server/connection.php';
                    $query = "SELECT BALANCE FROM customer WHERE CUST_ID='$id'";
                    $results = mysqli_query($conn,$query);
                    $row = mysqli_fetch_assoc($results);
                    $bal = $row['BALANCE'];
                ?>
                <div class="smallbox">
                    <p id="heading">Credit Amount</p>
                    <form action="server/cuaddcust.php" method="POST"> 
                    <table>
                        <tr><td>Available Balance: </td><td><input type="text" name="bal" value="<?php echo $bal ?>" readonly></td></tr>
                        <tr><td>Amount to credit: </td><td><input type="text" name="amount"></td></tr>
                        <tr><td colspan="2" style="text-align:center;"><input type="submit" name="Sub" value="Add amount"></td></tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>