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
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body>
        <div class="header">
            <img src="css/header.jpg" alt="Header img">
            <ul>
                <li><a href="admin.php">Home</a></li>
                <li><a href="server/logout.php">Logout</a></li>
                <li><a href="" style="padding:10px 535px;"></a></li>
            </ul>
        </div>
        <div class="container">
            <?php include 'adminnav.php' ?>
            <div class="tab">
                <?php
                    require 'server/connection.php';
                    $query = "SELECT * FROM customer";
                    $results = mysqli_query($conn,$query);
                    if(mysqli_num_rows($results)==0){
                        ?>
                        <p id="heading" style="margin:100px 432px">No customers!</p>
                        <?php
                    }else{
                        ?>
                        <p id="heading">Delete customer</p>
                        <table>
                        <tr>
                            <th>NAME</th>
                            <th>CUST_ID</th>
                            <th>AD_ID</th>
                            <th>PIN</th>
                            <th>AGE</th>
                            <th>ADDRESS</th>
                            <th>BALANCE</th>
                            <th>PHONO</th>
                            <th>EMAIL</th>
                            <th></th>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_assoc($results)){
                                $name = $row['NAME'];
                                $pin = $row['PIN'];
                                $age = $row['AGE'];
                                $add = $row['ADDRESS'];
                                $pho = $row['PHO'];
                                $cid = $row['CUST_ID'];
                                $aid = $row['AD_ID'];
                                $bal = $row['BALANCE'];
                                $email = $row['EMAIL'];
                            ?>
                                <form action="server/addelcust.php" method="POST">
                                    <tr>
                                        <td><input type="text" name="name" value="<?php echo $name ?>" readonly></td>
                                        <td><input type="text" name="cid" value="<?php echo $cid ?>" readonly></td>
                                        <td><input type="text" name="aid" value="<?php echo $aid ?>" readonly></td>
                                        <td><input type="password" name="pin" value="<?php echo $pin ?>" readonly></td>
                                        <td><input type="text" name="age" value="<?php echo $age ?>" readonly></td>
                                        <td><input type="text" name="add" value="<?php echo $add ?>" readonly></td>
                                        <td><input type="text" name="bal" value="<?php echo $bal ?>" readonly></td>
                                        <td><input type="text" name="pho" value="<?php echo $pho ?>" readonly></td>
                                        <td><input type="email" name="email" value="<?php echo $email ?>" readonly></td>
                                        <td><input type="submit" name="Sub" value="DELETE"></td>
                                    </tr>
                                </form>
                            <?php
                            }
                        ?>
                        </table>
                        <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>