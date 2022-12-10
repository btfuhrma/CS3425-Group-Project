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

<div class="exam-container">
    <form>
        <?php
            $questions = getExamQuestions($_SESSION["currentExam"]);
            $i = 0;
            foreach($questions as $question){
                $answers = getQuestionAnswers($question);
                $i++;
                echo '<div class="question"
                <p>Q'.$i.' '.$question.'</p>
                ';
                foreach($answers as $answer){
                    echo '
                    <input type="radio"> 
                    ';
                }
                echo '</div>';
            }
        ?>
    </form>
</div>
</html>