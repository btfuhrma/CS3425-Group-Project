<?php
    session_start();
    require "db.php";
?>
<html>
    <?php
        if (!isset($_SESSION["username"])) {
            header("LOCATION:login.php");
        }else {
            echo '<p align="right"> Dear Instructor '. $_SESSION["username"].', Welcome!</p>';
        }
    ?>
    <form action="login.php" method="get">
    <p>
    <input type="submit" value="logout" name="logout">
    <?php
    if (isset($_GET["logout"])) {
        header("LOCATION:login.php");
        session_destroy();
       }
    ?>
    </form> 
    </p>

    <form action="bankoperation.php" method="post">
        <p>Here are the courses you are teaching and the exams that you have created for each course</p>

    </form>
       
    <p>Please enter the course id and the exam name to see the score of the students</p>
        <form action="login.php" method="post" >
        <p>Course: 
            <input name="username" type="text">
        </p>
        <p>Exam: 
            <input name="password" type="text">
        </p>
        
        <button name="checkScore">Check Score</button>
        <button name="reviewExam">Review Exam</button>
        <button name="createExam">Create Exam</button>
        
        <?php
        if (isset($_POST["checkScore"])) {
            header("LOCATION:checkScore.php");
            
        }
        if (isset($_POST["revireExam"])) {
            header("LOCATION:reviewExam.php");
        }
        if (isset($_POST["createExam"])) {
            header("LOCATION:createExam.php");
        }
        ?>
        </form> 

    </body>
    
</html>