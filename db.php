<?php
    
    //Function for connecting to the database
    function connectDB() {
        $config = parse_ini_file("groupproject.ini");
        $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

    function authenticateUser($user, $passwd){
        try { 
            $dbh = connectDB(); 
            $statement = $dbh->prepare("SELECT count(*) FROM Student where account_name = :username and password = sha2(:passwd,256) "); 
            $statement2 = $dbh->prepare("SELECT count(*) FROM Instructor where account_name = :username and password = sha2(:passwd,256) ");
            $statement->bindParam(":username", $user); 
            $statement->bindParam(":passwd", $passwd); 
            $statement2->bindParam(":username", $user); 
            $statement2->bindParam(":passwd", $passwd); 
            $result = $statement->execute();
            $result = $statement2->execute();  
            $row=$statement->fetch(); 
            $row2=$statement2->fetch();
            $dbh=null; 
            if($row[0] == 1 || $row2[0] == 1){
                return 1;
            }else{
                return PHP_INT_MAX;
            }
        }catch (PDOException $e) { 
            print "Error!" . $e->getMessage() . "<br/>"; 
            die(); 
        } 
    }

    function firstTime($user, $passwd){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT password from Student where account_name = :username");
        $statement->bindParam(":username", $user);
        $result = $statement->execute();
        $pass = $statement->fetch();
        $dbh = null;
        if(strcmp($passwd, "password") == 0){
            return true;
        }
        else{
            return false;
        }
    }

    function isInstructor($user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT count(*) FROM Instructor where account_name = :username");
        $statement->bindParam(":username", $user);
        $result = $statement->execute();
        $row = $statement->fetch();
        $dbh = null;
        return $row[0];
    }

    function getCoursesInstructor($user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT course_id FROM Teach WHERE account_name = :username");
        $statement->bindParam(":username", $user);
        $result = $statement->execute();
        $row = $statement->fetchAll();
        $dbh = null;
        $courses = array();
        $i = 0;
        foreach($row as $course) {
            $courses[$i] = $course[0];
            $i++;
        }
        sort($courses);
        return ($courses);
    }
    function getCourseTitle($course){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT course_title FROM Course WHERE course_id = :course");
        $statement->bindParam(":course", $course);
        $statement->execute();
        $title = $statement->fetch();
        return $title[0];
    }
    function getCredits($course){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT credits FROM Course WHERE course_id = :course");
        $statement->bindParam(":course", $course);
        $statement->execute();
        $credits = $statement->fetch();
        return $credits[0];
    }
    function getOpenTime($examName){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT start_time FROM Exam WHERE exam_name = :examName");
        $statement->bindParam(":examName", $examName);
        $statement->execute();
        $startTime = $statement->fetch();
        return $startTime[0];
    }
    function getCloseTime($examName){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT end_time FROM Exam WHERE exam_name = :examName");
        $statement->bindParam(":examName", $examName);
        $statement->execute();
        $endTime = $statement->fetch();
        return $endTime[0];
    }
    function getTotalPoints($examName){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT total_points FROM Exam WHERE exam_name = :examName");
        $statement->bindParam(":examName", $examName);
        $statement->execute();
        $totalPoints = $statement->fetch();
        return $totalPoints[0];
    }
    function getExams($course){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT exam_name FROM examOf WHERE course_id = :course");
        $statement->bindParam(":course", $course);
        $result = $statement->execute();
        $row = $statement->fetchAll();
        $dbh = null;
        $exams = array();
        $i = 0;
        foreach($row as $exam) {
            $exams[$i] = $exam[0];
            $i++;
        }
        sort($exams);
        return ($exams);
    }

    function getInstructorName($course)
    {
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT account_name FROM Teach WHERE course_id =:course");
        $statement->bindParam(":course", $course);
        $statement->execute();
        $examName = $statement->fetch();
        return $examName[0];
    }
    function getCoursesStudent($user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT course_id FROM Register WHERE account_name = :username");
        $statement->bindParam(":username", $user);
        $result = $statement->execute();
        $row = $statement->fetchAll();
        $dbh = null;
        $courses = array();
        $i = 0;
        foreach($row as $course) {
            $courses[$i] = $course[0];
            $i++;
        }
        sort($courses);
        return ($courses);
    }
    function taken($exam, $user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT count(*) FROM Takes WHERE exam_name = :exam AND account_name = :user");
        $statement->bindParam(":exam", $exam);
        $statement->bindParam(":user", $user);
        $result = $statement->execute();
        $row = $statement->fetch();
        if($row[0] == 1){
            return true;
        }
        else{
            return false;
        }
    }
    function getStartTime($exam, $user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT start_time FROM Takes WHERE exam_name = :exam AND account_name = :user");
        $statement->bindParam(":exam", $exam);
        $statement->bindParam(":user", $user);
        $result = $statement->execute();
        $row = $statement->fetch();
        return $row[0];
    }
    function getEndTime($exam, $user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT end_time FROM Takes WHERE exam_name = :exam AND account_name = :user");
        $statement->bindParam(":exam", $exam);
        $statement->bindParam(":user", $user);
        $result = $statement->execute();
        $row = $statement->fetch();
        return $row[0];
    }
    function getScore($exam, $user){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT grade FROM Takes WHERE exam_name = :exam AND account_name = :user");
        $statement->bindParam(":exam", $exam);
        $statement->bindParam(":user", $user);
        $result = $statement->execute();
        $row = $statement->fetch();
        return $row[0];
    }
    function getAllCourses(){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT course_id FROM Course");
        $result = $statement->execute();
        $row = $statement->fetchAll();
        $dbh = null;
        $courses = array();
        $i = 0;
        foreach($row as $course) {
            $courses[$i] = $course[0];
            $i++;
        }
        sort($courses);
        return ($courses);   
    }
    function updatePassword($passwd, $user){
        $dbh = connectDB();
        if(isInstructor($user) == 1){
            $statement = $dbh->prepare("UPDATE Instructor SET password = :passwd WHERE account_name = :user");
        }
        else{
            $statement = $dbh->prepare("UPDATE Student SET password = :passwd WHERE account_name = :user");
        }
        $statement->bindParam(":passwd", $passwd);
        $statement->bindParam(":user", $user);
        $result = $statement->execute();
    }

    function courseExists($course){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT count(*) FROM Course WHERE course_id = :course");
        $statement->bindParam(":course", $course);
        $result = $statement->execute();
        $row = $statement->fetch();
        if($row[0] == 1){
            return true;
        }
        else{
            return false;
        }
    }
    function examExists($examName){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT count(*) FROM Exam WHERE exam_name = :examName");
        $statement->bindParam(":examName", $examName);
        $result = $statement->execute();
        $row = $statement->fetch();
        if($row[0] == 1){
            return true;
        }
        else{
            return false;
        }
    }

    function registerCourse($user, $course){
        $dbh = connectDB();
        $statement = $dbh->prepare("INSERT INTO Register VALUES(:accountName , :course)");
        $statement->bindParam(":accountName", $user);
        $statement->bindParam(":course", $course);
        $result = $statement->execute();
    }

    function isOpen($exam){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT start_time,end_time FROM Exam WHERE exam_name = :examName");
        $statement->bindParam(":examName", $exam);
        $statement->execute();
        $row = $statement->fetch();
        $start = $row[0];
        $end = $row[1];
        $now = strtotime(date('Y-m-d H:i:s'));
        if($now < $end && $now > $start){
            return true;
        }
        else{
            return false;
        }
    }
    function setStartTime($exam, $course, $user){
        $dbh = connectDB();
        $statement = $dbh->prepare("INSERT INTO Takes VALUES(:accountName , :course , :exam , :startTime)");
        $statement->bindParam(":accountName", $user);
        $statement->bindParam(":course", $course);
        $statement->bindParam(":exam", $exam);
        $statement->bindParam(":course", strtotime(date('Y-m-d H:i:s')));
        $result = $statement->execute();
    }

    function getCompleted($exam){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT COUNT(*) FROM Takes WHERE exam_name = :exam;");
        $statement->bindParam(":exam", $exam);
        $statement->execute();
        $completed = $statement->fetch();
        return $completed[0];
    }
    function getMaxScore($exam){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT MAX(grade) FROM Takes WHERE exam_name = :exam;");
        $statement->bindParam(":exam", $exam);
        $statement->execute();
        $max = $statement->fetch();
        return $max[0];
    }
    function getMinScore($exam){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT MIN(grade) FROM Takes WHERE exam_name = :exam;");
        $statement->bindParam(":exam", $exam);
        $statement->execute();
        $min = $statement->fetch();
        return $min[0];
    }
    function getAvgScore($exam){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT AVG(grade) FROM Takes WHERE exam_name = :exam;");
        $statement->bindParam(":exam", $exam);
        $statement->execute();
        $avg = $statement->fetch();
        return $avg[0];
    }

    function getTakenExam($exam){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT account_name FROM Takes WHERE exam_name = :exam;");
        $statement->bindParam(":exam", $exam);
        $statement->execute();
        $row = $statement->fetchAll();
        $dbh = null;
        $peoples = array();
        $i = 0;
        foreach($row as $people) {
            $peoples[$i] = $people[0];
            $i++;
        }
        sort($peoples);
        return ($peoples);   
    }

    function getName($student){
        $dbh = connectDB();
        $statement = $dbh->prepare("SELECT name FROM Student WHERE account_name = :user;");
        $statement->bindParam(":user", $student);
        $statement->execute();
        $name = $statement->fetch();
        return $name[0];
    }
?>
