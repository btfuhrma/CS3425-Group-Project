<html>
<?php
    session_start();
    require 'db.php';
    if (isset($_POST["checkScore"])) {
        
?>

<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse
    }
</style>
<div>
    <table>
        <tr>
            <th>
                <b>c_id</b>
            </th>
            <th>
                <b>Total</b>
            </th>
            <th>
                <b>Exam_Name</b>
            </th>
            <th>
                <b>Completed</b>
            </th>
            <th>
                <b>Minimum</b>
            </th>
            <th>
                <b>Maximum</b>
            </th>
            <th>
                <b>Average</b>
            </th>
        </tr>
        <?php
            $course = $_POST["course"];
            $exam = $_POST["exam"];
            for($x = 0; $x < 1; $x++) {
                    echo '<tr>
                            <td>' . $course . '</td>
                            <td>' . getCredits($course) . '</td>
                            <td>' . $exam . '</td>
                            <td>' . getCompleted($exam) . '</td>
                            <td>' . getMinScore($exam) . '</td>
                            <td>' . getMaxScore($exam) . '</td>
                            <td>' . getAvgScore($exam) . '</td>
                            </tr>';
                }
            ?>
    </table>
</div>
<br>
<div>
    <table>
        <tr>
            <th>
                <b>id</b>
            </th>
            <th>
                <b>Name</b>
            </th>
            <th>
                <b>Start_Time</b>
            </th>
            <th>
                <b>End_Time</b>
            </th>
            <th>
                <b>Score</b>
            </th>
        </tr>
        <?php
        
            $course = $_POST["course"];
            $exam = $_POST["exam"];
            $allstudents = getTakenExam($exam);
            foreach($allstudents as $student) {
                    echo '<tr>
                            <td>' . $student . '</td>
                            <td>' . getName($student) . '</td>
                            <td>' . getStartTime($exam, $student) . '</td>
                            <td>' . getEndTime($exam, $student) . '</td>
                            <td>' . getScore($exam, $student) . '</td>
                            </tr>';
                }
            ?>
    </table>
</div>
<br>
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

<?php
    if (isset($_POST["reviewExam"])) {

?>

This is the Review Exam Page!<br>
Here are the questions for exam (exam name)<br>
exam questions....<br>
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