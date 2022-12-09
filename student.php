<?php
    session_start();
    require "db.php";
    if (!isset($_SESSION["username"])) {
        header("LOCATION:login.php");
} else {
    echo '<p align="left"> Dear student ' . $_SESSION["username"] . '@mtu.edu, Welcome!</p>';
}
?>
<html>
    
<form action="student.php" method="post" >
    <input type="submit" name="logout" value="logout">
        <?php
        if (isset($_POST["logout"])) {
            session_destroy();
            header("LOCATION:login.php");
        }
        ?>
</form>
<div>
    <p>Here are the classes you are taking</p>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse
        }
        </style>
    <table>
        <tr>
            <th>
                <b>c_id</b>
            </th>
            <th>
                <b>Title</b>
            </th>
            <th>
                <b>Credit</b>
            </th>
            <th>
                <b>Name</b>
            </th>
        <tr>
            <?php
            $courses = getCoursesStudent($_SESSION["username"]);
            foreach ($courses as $course) {
                    echo '<tr>
                            <td>' . $course . '</td>
                            <td>' . getCourseTitle($course) . '</td>
                            <td>' . getCredits($course) . '</td>
                            <td>' . getInstructorName($course) . '</td>
                            </tr>';
                }
            ?>
    </table>
</div>
<div>
    <p>Here are the exams in each course and your score</p>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse
        }
        </style>
    <table>
        <tr>
            <th>
                <b>c_id</b>
            </th>
            <th>
                <b>exam_name</b>
            </th>
            <th>
                <b>open_time</b>
            </th>
            <th>
                <b>close_time</b>
            </th>
            <th>
                <b>total_points</b>
            </th>
            <th>
                <b>start_time</b>
            </th>
            <th>
                <b>end_time</b>
            </th>
            <th>
                <b>score</b>
            </th>
        <tr>
    </table>
</div>
<div>
    <p>Here is the list of classes that you are not enrolled in yet</p>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse
        }
        </style>
    <table>
        <tr>
            <th>
                <b>id</b>
            </th>
            <th>
                <b>Title</b>
            </th>
            <th>
                <b>Credits</b>
            </th>
            <th>
                <b>instructor_id</b>
            </th>
        <tr>
    </table>
</div>
<div>
    <p>To register new courses, please type the course id, then click the "Register New Course" button.</p>
    <p>To take an exam, please type the course id and the exam name, then click the "Take Exam" button.</p>
    <p>To check the exam score, please type the course id and the exam name, then click the "Check Score" button.</p>
    <p>Course: 
            <input name="username" type="text">
        </p>
        <p>Exam: 
            <input name="password" type="text">
        </p>
        <form action="examStudent.php" method="post" >
        <button name="registerCourse">Register New Course</button>
        <button name="takeExam">Take Exam</button>
        <button name="checkScore">Check Score</button>
        </form> 

</div>
</html>
