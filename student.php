<?php
    session_start();
    require "db.php";
    if (!isset($_SESSION["username"])) {
        header("LOCATION:login.php");
} else {
    echo '<p align="left"> Dear student ' . $_SESSION["username"] . ',@mtu.edu, Welcome!</p>';
}
?>
<html>
    
<form action="student.php" method="post" >
    <input type="submit" name="logout">
        <?php
        if (isset($_POST["logout"])) {
            session_destroy();
            header("LOCATION:login.php");
        }
        ?>
</form>
</html>
