<?php
session_start();
require "db.php";
if(isset($_SESSION["username"])){
    if(isInstructor($_SESSION["username"]) == 1){
        header('LOCATION: instructor.php');
    }else{
        header('LOCATION: student.php');
    }
}
?>
<link rel="stylesheet" href="style.css">
<title>Canvas</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    html,body {
        margin: 0;
        height: 80%;
    }

    .user {
        background-color: #000000;
        padding: 30px;
    }

    .logincontainer {
        height: 100%;
        background-color: #ffffff;
        overflow: hidden;
        vertical-align: top;
    }
    .login{
        background-color:#d5d5d5;
        border-radius: 8px;
        margin-top: 50;
        margin-left: 125;
        width: 630px;
        height: 400px;
        font-size: 15px;
        font-family: Verdana, sans-serif;
    }
    .user-input{
        padding: 40px 0px 10px 30px;
    }
    .pass-input{
        padding: 0px 0px 10px 30px;
    }
    .inputbtn{
        padding: 10px 0px 10px 20px;
    }
    .submit-input{
        height:45px; 
        width:575px; 
        font-size: 20px; 
        background-color:#ffcd00;
        border: none;
    }
    .submit-input:hover{
        background-color: #A9A9A9;
        text-decoration: underline;
        border: none;
        cursor: pointer;
    }
    .text{
        padding: 40px 0px 10px 30px;
    }
    .resize{
        padding-left: 100px;
        max-width: 20%;
        max-height: 20%;
    }
</style>
<header class="user">
    <img src="mtu logo.png" class="resize">
</header>

<body>
    <div class="logincontainer">
        <div class="login"> 
        <form method="POST" action="login.php">
            <div class="user-input">
                <label for="">Username:</label><br>
                <input type="text" name="username" style="height:45px; width:555px; font-size: 20px;">
            </div>
            <div class="pass-input">
                <label for="">Password:</label><br>
                <input type="password" name="password" style="height:45px; width:555px; font-size: 20px;"><br>
            </div>
            <div class="inputbtn">
                <input class="submit-input" type="submit" name="loginSubmit" value="LOGIN" style="height:42px;">
            </div>
            <p class="text">By logging into this system you agree to abide by Michigan Tech's Acceptable Use of Information Technology Resources.<p>
        </form>
        </div>
    </div>

    <?php
    if (isset($_POST["loginSubmit"])) {
        if (authenticateUser($_POST["username"], $_POST["password"]) == 1 && firstTime($_POST["username"], $_POST["password"]) == true) {
            $_SESSION["username"] = $_POST["username"];
            header('LOCATION: changePassword.php');
        } else if (authenticateUser($_POST["username"], $_POST["password"]) == 1 && firstTime($_POST["username"], $_POST["password"]) == false) {
            $_SESSION["username"] = $_POST["username"];
            if (isInstructor($_POST["username"]) == 1) {
                header('LOCATION: instructor.php');
            } else {
                header('LOCATION: student.php');
            }

        } else {
            echo 'wrong password';
        }
    }
    ?>
</body>