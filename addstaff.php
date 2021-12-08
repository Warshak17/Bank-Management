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
            <div class="tab">
                <form action="server/adaddstaff.php" method="POST">
                <div class="smallbox">
                <p id="heading">New Staff details</p>
                <table>
                    <tr><td>Enter Id: </td><td><input type="text" name="id"></td></tr>
                    <tr><td>Enter Name: </td><td><input type="text" name="name"></td></tr>
                    <tr><td>Enter pin: </td><td><input type="password" name="pin"></td></tr>
                    <tr><td>Phone Number: </td><td><input type="text" name="pho"></td></tr>
                    <tr><td>Enter Age: </td><td>
                    <select name="age">
                    <option value="" selected>---</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                </select></td></tr>
                <tr><td colspan="2" style="text-align:center;"><input type="submit" value="Add Staff" name="Sub"></td></tr>
                </table>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>