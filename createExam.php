<html>
    This function is not implemented yet<br>

    <form action="main.php" method="post" >
        <button name="goBack">Go Back</button>
        <?php
        if (isset($_POST["goBack"])) {
            header("LOCATION:checkScore.php");
        }
        ?>
    </form> 
</html>