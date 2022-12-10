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
                $letter = chr(65);
                echo '<div class="question"
                <p>Q'.$i.' '.$question.'</p>
                ';
                foreach($answers as $answer){
                    $letter = chr($letter + 1);
                    echo '
                    <div>
                    <input type="radio" name="'.$answer.'" value="'.$letter.'"> 
                    <label for="'.$answer.'">'.$letter.': '.$answer.'</label> 
                    </div>';
                }
                echo '</div>';
            }
        ?>
    </form>
</div>
</html>