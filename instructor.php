<?php
    session_start();
    require "db.php";
?>
<html>
    <?php
        if (!isset($_SESSION["username"])) {
            header("LOCATION:login.php");
        }else {
            echo '<p align="left"> Dear Instructor '. $_SESSION["username"].', Welcome!</p>';
        }
    ?>

    <form action="instructor.php" method="post">
        <input type="submit" value="logout" name="logout">
        <?php
               if (isset($_POST["logout"])) {
                    session_destroy();
                    header("LOCATION:login.php");
                    
                }
                ?>
    </form>

    <div>
        <p>Here are the courses you are teaching and the exams that you have created for each course</p>
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
                    <b>ID</b>
                </th>
                <th>
                    <b>Title</b>
                </th>
                <th>
                    <b>Credit</b>
                </th>
                <th>
                    <b>Exam Name</b>
                </th>
                <th>
                    <b>Open Time</b>
                </th>
                <th>
                    <b>Close Time</b>
                </th>
                <th>
                    <b>Total Points</b>
                </th>

            </tr>
            <?php
                $courses = getCoursesInstructor($_SESSION["username"]);
                foreach($courses as $course){
                    $exams = getExams($course);
                    foreach($exams as $exam){
                        echo '<tr>
                        <td>'.$course.'</td>
                        <td>'.getCourseTitle($course).'</td>
                        <td>'.getCredits($course).'</td>
                        <td>'.$exam.'</td>
                        <td>'.getOpenTime($exam).'</td>
                        <td>'.getCloseTime($exam).'</td>
                        <td>'.getTotalPoints($exam).'</td>
                        </tr>';
                    }
                }
            ?>
        </table>
    </div>
       
    <p>Please enter the course id and the exam name to see the score of the students</p>
        
        <p>Course: 
            <input name="username" type="text">
        </p>
        <p>Exam: 
            <input name="password" type="text">
        </p>
        <form action="examInstructor.php" method="post" >
        <button name="checkScore">Check Score</button>
        <button name="reviewExam">Review Exam</button>
        <button name="createExam">Create Exam</button>
        </form> 

        <?php
        if (isset($_POST["checkScore"])) {
            header("LOCATION:examInstructor.php");
        }
        if (isset($_POST["checkScore"])) {
            header("LOCATION:examInstructor.php");
        }
        if (isset($_POST["checkScore"])) {
            header("LOCATION:examInstructor.php");
        }
        ?>

    </body>
    
</html>
