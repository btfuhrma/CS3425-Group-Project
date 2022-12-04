<?php
    
    //Function for connecting to the database
    function connectDB() {
        $config = parse_ini_file("groupproject.ini");
        $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

    function authenticateUser($user, $passwd){
        try { 
            $dbh = connectDB(); 
            $statement = $dbh->prepare("SELECT count(*) FROM Student where account_name = :username and password = sha2(:passwd,256) "); 
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

    function firstTime($user, $passwd){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT password from Student where account_name = :username and password = sha2(:passwd,256)");
        $statement->bindParam(":username", $user);
        $statement->bindParam(":passwd", $passwd);
        $result = $statement->execute();
        $pass = $statement->fetch();
        if(strcmp($pass, "password123") == 1){
            return true;
        }
        else{
            return false;
        }
    }

    function isInstructor($user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT count(*) FROM Instructor where account_name = :username");
        $statement->bindParam(":username", $user);
        $result = $statement->execute();
        $row = $statement->fetch();
        return $row[0];
    }
?>