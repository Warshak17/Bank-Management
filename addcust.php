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
                    $query = "SELECT * FROM pending";
                    $results = mysqli_query($conn,$query);
                    if(mysqli_num_rows($results)==0){
                        ?>
                        <p id="heading" style="margin:100px 432px">No new customers!</p>
                        <?php
                    }else{
                        ?>
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
                                $pho = $row['PHONO'];
                                $email = $row['EMAIL'];
                            ?>
                                <form action="server/adaddcust.php" method="POST">
                                    <tr>
                                        <td><input type="text" name="name" value="<?php echo $name ?>" readonly></td>
                                        <td><input type="text" name="cid" required></td>
                                        <td><input type="text" name="aid" value="<?php echo $id ?>" readonly></td>
                                        <td><input type="password" name="pin" value="<?php echo $pin ?>" readonly></td>
                                        <td><input type="text" name="age" value="<?php echo $age ?>" readonly></td>
                                        <td><input type="text" name="add" value="<?php echo $add ?>" readonly></td>
                                        <td><input type="text" name="bal" required></td>
                                        <td><input type="text" name="pho" value="<?php echo $pho ?>" readonly></td>
                                        <td><input type="email" name="email" value="<?php echo $email ?>"></td>
                                        <td><input type="submit" name="Sub" value="ADD"></td>
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