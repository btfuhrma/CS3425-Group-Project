<html>
<?php
    session_start();
    require 'db.php';

    if(isset($_POST["registerCourse"])){
        if(courseExists($_POST["courseName"])){
            registerCourse($_SESSION["username"], $_POST["courseName"]);
            $_SESSION["newCourse"] = $_POST["courseName"];
            header('LOCATION: newCourse.php');
        }
    }
    if(isset($_POST["takeExam"])){
        if(courseExists($_POST["courseName"]) && examExists($_POST["examName"]) && isOpen($_POST["examName"])){
            setStartTime($_POST["examName"], $_POST["courseName"], $_SESSION["username"]);
            $_SESSION["currentExam"] = $_POST["examName"];
            $_SESSION["courseName"] = $_POST["courseName"];
        }
        else{
            
            header('LOCATION: student.php');
        }
    }
    if(isset($_POST["checkScore"])){
        if(courseExists($_POST["courseName"]) && examExists($_POST["examName"]) && taken($_POST["examName"], $_SESSION["username"])){
            $_SESSION["currentExam"] = $_POST["examName"];
            $_SESSION["courseName"] = $_POST["courseName"];
            header('LOCATION: checkScore.php');
        }
        else{
            header('LOCATION: student.php');
        }
    }
    if (!isset($_SESSION["currentExam"])) {
        header('LOCATION: student.php');
    }
?>

<p>
    Go back to student page
</p>
<form action="student.php" method="post">
<button name="goBack">Go Back</button>
</form>

<div class="exam-container">
    <form method="POST" action="checkScore.php">
        <?php
            $questions = getExamQuestions($_SESSION["currentExam"]);
            $i = 0;
            foreach($questions as $question){
                $answers = getQuestionAnswers($question);
                $i++;
                $letterN = 64;
                echo '<div class="question"
                <p>Q'.$i.': '.$question.'</p>
                ';
                foreach($answers as $answer){
                    $letterN++;
                    $letter = chr($letterN);
                    echo '
                    <div>
                    <input type="radio" name="'.$question.'" value="'.$answer.'"> 
                    <label for="'.$question.'">'.$letter.': '.$answer.'</label> 
                    </div>';
                }
                echo '</div>';
            }
        ?>
        <input type="submit" name="examSubmit" value="Submit Exam">
    </form>
</div>
</html>