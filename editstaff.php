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
                    $query = "SELECT * FROM admin";
                    $results = mysqli_query($conn,$query);
                    if(mysqli_num_rows($results)==0){
                        ?>
                        <p id="heading" style="margin:100px 432px">No admin!</p>
                        <?php
                    }else{
                        ?>
                        <p id="heading">Edit Admin details</p>
                        <table>
                        <tr>
                            <th>Name</th>
                            <th>Admin id</th>
                            <th>PIN</th>
                            <th>AGE</th>
                            <th>PHONO</th>
                            <th></th>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_assoc($results)){
                                $name = $row['NAME'];
                                $pin = $row['PIN'];
                                $age = $row['AGE'];
                                $pho = $row['PHO_NO'];
                                $aid = $row['AD_ID'];
                            ?>
                                <form action="" method="POST">
                                    <tr>
                                        <td><input type="text" name="name" value="<?php echo $name ?>" readonly></td>
                                        <td><input type="text" name="aid" value="<?php echo $aid ?>" readonly></td>
                                        <td><input type="password" name="pin" value="<?php echo $pin ?>" readonly></td>
                                        <td><input type="text" name="age" value="<?php echo $age ?>" readonly></td>
                                        <td><input type="text" name="pho" value="<?php echo $pho ?>" readonly></td>
                                        <td><input type="submit" name="Sub" value="EDIT"></td>
                                    </tr>
                                </form>
                            <?php
                            }
                        ?>
                        </table>
                        <?php
                            if(isset($_POST['Sub'])){
                                $name = $_POST['name'];
                                $age = $_POST['age'];
                                $pho = $_POST['pho'];
                                $aid = $_POST['aid'];
                                ?>
                                <div style="position: absolute;left: 50%;transform:translate(-50%);">
                                <p id="heading">Edit details for <?php echo $_POST['name'] ?></p>
                                <form action="server/adeditstaff.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $aid ?>">
                                    <table>
                                        <tr><td>Name: </td><td><input type="text" name="name" value="<?php echo $name ?>"></td></tr> 
                                        <tr><td>Age: </td><td><input type="text" name="age" value="<?php echo $age ?>"></td></tr>
                                        <tr><td>Phone number: </td><td><input type="text" name="pho" value="<?php echo $pho ?>"></td></tr>
                                        <tr><td colspan="2" style="text-align:center;"><input type="submit" name="Sub" value="Change details"></td></tr>
                                    </table>
                                </form>
                                <div>
                                <?php
                            }
                        ?>
                        <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>