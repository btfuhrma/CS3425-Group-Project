<html>
<?php
    if (!isset($_SESSION["currentExam"])) {
        //header('LOCATION: student.php');
    }
?>

<p>
    Go back to student page
</p>
<form action="student.php" method="post">
<button name="goBack">Go Back</button>
</form>



</html>