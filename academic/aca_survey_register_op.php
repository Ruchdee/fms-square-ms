<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_survey_register.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $survey_register = new Survey_register($db);

    //i = insert
    if (isset($_POST['survey-action']) && $_POST['survey-action'] == 'i') {
        $survey_register->survey_id = $_POST['survey-id'];
        $survey_register->student_id = $_SESSION['std_id'];
        $survey_register->course_code1 = $_POST['course-code1'];
        $survey_register->course_code2 = $_POST['course-code2'];
        $survey_register->course_code3 = $_POST['course-code3'];
        $survey_register->course_code4 = $_POST['course-code4'];
        $survey_register->course_code5 = $_POST['course-code5'];
        $survey_register->course_code6 = $_POST['course-code6'];
        $survey_register->remark = $_POST['remark-txt'];
        $survey_register->registered_date = date("Y/m/d H:i:s");
        //insert
        if ($survey_register->create()) {
            header("Location: aca_survey_list.php?msg=success");
        } else {
            header("Location: aca_survey_list.php?msg=insert-error");
       }
    }

    //u = update
    if (isset($_POST['survey-action']) && $_POST['survey-action'] == 'u') {
        $survey_register->survey_id = $_POST['survey-id'];
        $survey_register->student_id = $_SESSION['std_id'];
        $survey_register->course_code1 = $_POST['course-code1'];
        $survey_register->course_code2 = $_POST['course-code2'];
        $survey_register->course_code3 = $_POST['course-code3'];
        $survey_register->course_code4 = $_POST['course-code4'];
        $survey_register->course_code5 = $_POST['course-code5'];
        $survey_register->course_code6 = $_POST['course-code6'];
        $survey_register->remark = $_POST['remark-txt'];
        //update
        if ($survey_register->update()) {
            header("Location: aca_survey_list.php?msg=success");
        } else {
            header("Location: aca_survey_list.php?msg=update-error");
        }
    }

?>