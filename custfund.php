<?php
    session_start();
    if(isset($_SESSION['name'])){
        $id = $_SESSION['id'];
        require 'server/connection.php';
        $query = "SELECT NAME FROM customer";
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
            <form action="server/cufund.php" method="POST">
            <div class="smallbox">
                <p id="heading">Fund Transfer</p>
                <table>
                    <tr><td>Who to transfer</td><td><select name="name">
                        <option value="" selected>---</option>
                        <?php
                            while($row = mysqli_fetch_assoc($results)){
                                $name = $row['NAME'];
                                if($name!=$_SESSION['name']){
                                ?>
                                    <option value="<?php echo $name ?>"><?php echo $name ?></option>
                                <?php
                                }
                            }
                        ?>
                    </select></td></tr>
                    <?php
                        $query = "SELECT BALANCE FROM customer WHERE CUST_ID='$id'";
                        $results = mysqli_query($conn,$query);
                        $row = mysqli_fetch_assoc($results);
                        $bal = $row['BALANCE'];
                    ?>
                    <tr><td>Your balance: </td><td><input type="text" value="<?php echo $bal ?>" name="bal" readonly></td></tr>
                    <tr><td>How much to tranfer:</td><td><input type="text" name="amount"></td></tr>
                    <tr><td colspan="2" style="text-align:center"><input type="submit" value="Transfer" name="Sub"></td></tr>
                </table>
            </div>
            </form>
            </div>
        </div>
    </body>
</html>