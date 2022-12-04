<!DOCTYPE html>
<?php
    session_start();
    require "db.php";
?>

<header>
    <link rel="stylesheet" href="style.css">
    <title>Canvas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
</header>

<body>
    <div class="login container">
        <form method="POST" action="login.php">
            <div class="login-input">
                <label for="">Username</label>
                <input type="text" name="username">
            </div>
            <div class="login-input">
                <label for="">Password</label>
                <input type="password" name="password">
            </div>
            <div class="login-input">
                <input type="submit" name="loginSubmit">
            </div>
        </form>
    </div> 
    <?php
        if(isset($_POST["loginSubmit"])){
            if(authenticateUser($_POST["username"], $_POST["password"]) == 1 && firstTime($_POST["username"], $_POST["password"]) == true){
                header('LOCATION: changePassword.php');
            }
            else if(authenticateUser($_POST["username"], $_POST["password"])==1 && firstTime($_POST["username"], $_POST["password"]) == false ){
                $_SESSION["username"] = $_POST["username"];
            }
        }
    ?>
</body>