<?php
session_start();
require "db.php";
?>
<link rel="stylesheet" href="style.css">
<title>Canvas</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    html,body {
        margin: 0;
        height: 100%;
    }

    .user {
        background-color: #000000;
        text-align: center;
        padding: 60px;
    }

    .logincontainer {
        height: 100%;
        background-color: #d5d5d5;
        overflow: hidden;
        vertical-align: top;
    }
    .login{
        background-color: #aaaaaa;
        border-radius: 10px;
        margin-top: 40;
        margin-left: 150;
        width: 600px;
        height: 400px;
        font-size: 15px;
        font-family: Verdana, sans-serif;
    }
    .user-input{
        padding: 30px 0px 10px 30px;
    }
    .pass-input{
        padding: 0px 0px 10px 30px;
    }
    .inputbtn{
        padding: 0px 0px 10px 30px;
    }
    .submit-input{
        height:45px; 
        width:525px; 
        font-size: 20px; 
        background-color:#ffcd00;
        border: none;
    }
    .submit-input:hover{
        background-color: #d5d5d5;
        text-decoration: underline;
        border: none;
        cursor: pointer;
    }
    .text{
        padding: 0px 0px 10px 30px;
    }
</style>
<header class="user">
    <img src="C:\Users\leiya\OneDrive\Documents\Michigan Tech\Fall 2022\mtu logo.png">
</header>

<body>
    <div class="logincontainer">
        <div class="login"> 
        <form method="POST" action="login.php">
            <div class="user-input">
                <label for="">Username:</label><br>
                <input type="text" name="username" style="height:45px; width:525px; font-size: 20px;">
            </div>
            <div class="pass-input">
                <label for="">Password:</label><br>
                <input type="password" name="password" style="height:45px; width:525px; font-size: 20px;"><br>
            </div>
            <div  class="inputbtn">
                <input class="submit-input" type="submit" name="loginSubmit" value="Login">
            </div>
            <p class="text">By logging into this system you agree to abide by Michigan Tech's Acceptable Use of Information Technology Resources.<p>
        </form>
        </div>
    </div>

    <?php
    if (isset($_POST["loginSubmit"])) {
        if (authenticateUser($_POST["username"], $_POST["password"]) == 1 && firstTime($_POST["username"], $_POST["password"]) == true) {
            header('LOCATION: changePassword.php');
        } else if (authenticateUser($_POST["username"], $_POST["password"]) == 1 && firstTime($_POST["username"], $_POST["password"]) == false) {
            $_SESSION["username"] = $_POST["username"];
            echo isInstructor($_POST["username"]);
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