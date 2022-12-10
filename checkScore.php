<html>
    <?php
        session_start();
        require 'db.php';
        if(isset($_POST["examSubmit"])){
            $questions = getExamQuestions($_SESSION["currentExam"]);
            foreach($questions as $question){
                gradeQuestion($_SESSION["username"], $_SESSION["courseName"], $_SESSION["currentExam"], $question, $_POST[$question]);
            }
        }
    ?>
</html>