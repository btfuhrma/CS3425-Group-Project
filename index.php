<?php
    session_start();
    require "groupproject.ini";

    if(!isset($_SESSION["username"])){
        header('LOCATION: login.php');
    }
?>