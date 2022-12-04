<?php
    session_start();
    require "db.php";

    if(!isset($_SESSION["username"])){
        header('LOCATION: login.php');
    }
?>