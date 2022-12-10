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
                <td>'.$end.'<td>
                <td>'.date_diff(DateTime::createFromFormat('Y-m-d H:i:s', strtotime($start)), DateTime::createFromFormat('Y-m-d H:i:s',strtotime($end))).'</td>
                ';
            ?>
        </tr>
    </table>
</html>