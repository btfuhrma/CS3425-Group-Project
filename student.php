<?php
    session_start();
    require "db.php";
?>
<html>
<form action="login.php" method="post" >
    <button name="logout">logout</button>
        <?php
        if (isset($_POST["logout"])) {
            header("LOCATION:login.php");

        }
        ?>
</form>
</html>
