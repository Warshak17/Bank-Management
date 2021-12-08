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
                <form action="server/adadminchange.php" method="POST">
                <div class="smallbox">
                <p id="heading">Change Pin Number</p>
                <table>
                    <tr><td>Enter pin: </td><td><input type="password" name="pin1"></td></tr>
                    <tr><td>Confirm pin: </td><td><input type="password" name="pin2"></td></tr>
                    <tr><td colspan="2" style="text-align:center;"><input type="submit" value="Change Pin" name="Sub"></td></tr>
                </table>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>