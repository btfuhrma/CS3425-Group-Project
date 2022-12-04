<?php
    
    //Function for connecting to the database
    function connectDB() {
        $config = parse_ini_file("gruopproject.ini");
        $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

    function authenticateUser($user, $passwd){
        try { 
            $dbh = connectDB(); 
            $statement = $dbh->prepare("SELECT count(*) FROM lab4_customer where username = :username and password = sha2(:passwd,256) "); 
            $statement->bindParam(":username", $user); 
            $statement->bindParam(":passwd", $passwd); 
            $result = $statement->execute(); 
            $row=$statement->fetch(); 
            $dbh=null; 
     
            return $row[0]; 
        }catch (PDOException $e) { 
            print "Error!" . $e->getMessage() . "<br/>"; 
            die(); 
        } 
    }

?>