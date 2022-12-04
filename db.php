<?php
    
    //Function for connecting to the database
    function connectDB() {
        $config = parse_ini_file("gruopproject.ini");
        $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }


?>