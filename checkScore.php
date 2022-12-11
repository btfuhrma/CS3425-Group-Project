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
                <b>
                    Score
                </b>
            </th>
            <th>
                <b>
                    Start Time
                </b>
            </th>
            <th>
                <b>
                    End Time
                </b>
            </th>
            <th>
                <b>
                    Duration in Seconds
                </b>
            </th>
        </tr>
        <tr>
            <?php
                $start = getStartTime($_SESSION["currentExam"], $_SESSION["username"]);
                $end = getEndTime($_SESSION["currentExam"], $_SESSION["username"]);
                echo '
                <td>'.getscore($_SESSION["currentExam"], $_SESSION["username"]).'</td>
                <td>'.$start.'</td>
                <td>'.$end.'</td>
                <td>'.getTimeDifference($_SESSION["currentExam"], $_SESSION["username"]).'</td>
                ';
            ?>
        </tr>
    </table>
</html>