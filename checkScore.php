<html>
    <?php
        session_start();
        require 'db.php';
        if(isset($_POST["examSubmit"])){
            setEndTime($_SESSION["username"], $_SESSION["currentExam"]);
            $questions = getExamQuestions($_SESSION["currentExam"]);
            foreach($questions as $question){
                gradeQuestion($_SESSION["username"], $_SESSION["courseName"], $_SESSION["currentExam"], $question, $_POST[str_replace(" ", "_", $question)]);
            }
        }
    ?>
</html>