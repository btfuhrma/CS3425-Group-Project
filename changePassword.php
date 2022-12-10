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
        <form method="POST" action="changePassword.php">
            <div class="user-input">
                <label for="">New Password:</label><br>
                <input type="password" name="newPassword" style="height:45px; width:555px; font-size: 20px;">
            </div>
            <div class="inputbtn">
                <input class="submit-input" type="submit" name="newPasswordSubmit" value="Update Password" style="height:42px;">
            </div>
        </form>
        </div>
    </div>
    <?php
        if(isset($_POST["newPasswordSubmit"])){
            updatePassword($_POST["newPassword"], $_SESSION["username"]);
            if(isInstructor($_SESSION["username"] == 1)){
                header('LOCATION: instructor.php');
            }
            else{
                header('LOCATION: student.php');
            }
        }
    ?>
</body>