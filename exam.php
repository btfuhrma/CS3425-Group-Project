<html>
<?php
    if (isset($_POST["checkScore"])) {

?>

This is the Check Score Page!<br>
Table for exam info<br>
Table for student exam info<br>
go back button

<?php
    }
?>

<?php
    if (isset($_POST["reviewExam"])) {

?>

This is the Review Exam Page!<br>
Here are the questions for exam (exam name)<br>
exam questions....<br>
go back button

<?php
    }
?>

<?php
    if (isset($_POST["createExam"])) {

?>
This function is not implemented yet<br>

<form action="instructor.php" method="post">
    <button name="goBack">Go Back</button>
    <?php
        if (isset($_POST["goBack"])) {
            header("LOCATION:instructor.php");
        }
    ?>
</form>

<?php
    }
?>

</html>