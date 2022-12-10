<html>
    <?php
        session_start();
        require 'db.php';
    ?>
    <p>
        You have been added to 
        <?php
            echo $_SESSION["newCourse"];
        ?>
    </p>
    <form method="POST" action="student.php">
        <input type="submit" value="Go Back">
    </form>
</html>