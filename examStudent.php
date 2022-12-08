<html>
<?php
    if (isset($_POST["registerCourse"])) {

?>

This is the Register Course page!<br>
<form action="student.php" method="post">
<button name="goBack">Go Back</button>
    <?php
        if (isset($_POST["goBack"])) {
            header("LOCATION:student.php");
        }
    ?>
</form>

<?php
    }
?>

<?php
    if (isset($_POST["takeExam"])) {

?>

This is the Take Exam Page!<br>
Here are the questions for exam (exam name)<br>
exam questions....<br>
<form action="student.php" method="post">
<button name="goBack">Go Back</button>
    <?php
        if (isset($_POST["goBack"])) {
            header("LOCATION:student.php");
        }
    ?>
</form>

<?php
    }
?>

<?php
    if (isset($_POST["checkScore"])) {

?>
Here is the Check Score Page!<br>

<form action="student.php" method="post">
    <button name="goBack">Go Back</button>
    <?php
        if (isset($_POST["goBack"])) {
            header("LOCATION:student.php");
        }
    ?>
</form>

<?php
    }
?>

</html>