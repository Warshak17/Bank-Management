<?php
    session_start();
    if(isset($_SESSION['name'])){

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
            <div class="adstaff">
                <p id="heading">Staff</p>
                <ul>
                    <li><a href="addstaff.php">Add Staffs</a></li>
                    <li><a href="editstaff.php">Edit Staff</a></li>
                    <li><a href="delstaff.php">Delete Staff</a></li>
                </ul>
            </div>
            <div class="adcust">
                <p id="heading">Customer</p>
                <ul>
                    <li><a href="addcust.php">Add Customer</a></li>
                    <li><a href="editcust.php">Edit Customer</a></li>
                    <li><a href="delcust.php">Delete Customer</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>