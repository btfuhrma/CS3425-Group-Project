<html>
    <?php
        session_start();
        require 'db.php';
    ?>
    <p>
        You have been added to 
        <?php
            echo $_POST["courseName"];
        ?>
    </p>
    <form method="POST" action="student.php">
        <input type="submit" value="Go Back">
    </form>
</html>