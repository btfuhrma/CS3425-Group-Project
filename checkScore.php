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
    <table style="margin-bottom: 20px;">
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
    <table>
    <tr>
            <th>
                <b>
                    Question Number
                </b>
            </th>
            <th>
                <b>
                    Description
                </b>
            </th>
            <th>
                <b>
                    Your Answer
                </b>
            </th>
            <th>
                <b>
                    Your Points
                </b>
            </th>
            <th>
                <b>
                    Correct Answer
                </b>
            </th>
        </tr>
        <?php
            $questions = getExamQuestions($_SESSION["currentExam"]);
            $i = 1;
            foreach($questions as $question){
                echo '<tr>
                <td>'.$i.'</td>
                <td>'.$question.'</td>
                <td>'.getUserAnswer($_SESSION["username"], $_SESSION["currentExam"], $question).'</td>
                ';
                if(strcmp(getUserAnswer($_SESSION["username"], $_SESSION["currentExam"], $question), getCorrect($question)) == 0){
                    echo '<td>
                    '.getPoints($question, $_SESSION["currentExam"]).'
                    </td>';
                }else{
                    echo '<td>
                    0
                    </td>';
                }
                echo '<td>'.getCorrect($question).'</td>
                </tr>';
                $i++;
            }
        ?>
    </table>
</html>