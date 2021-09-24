<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_survey.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $survey = new Course_survey($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $survey->survey_title = $_POST['survey-title'];
        $survey->survey_desc = $_POST['survey-desc-txt'];
        $survey->survey_deadline = $_POST['survey-deadline'];
        $survey->survey_status = $_POST['survey-status'];
        $survey->academic_year = $_SESSION['academic_year'];
        $survey->semester = $_SESSION['semester'];
        $survey->created_by = $_SESSION['staff_id'];
        $survey->created_date = date("Y/m/d H:i:s");

        //insert
        if ($survey->create()) {
            header("Location: aca_course_survey.php?msg=success");
        } else {
           header("Location: aca_course_survey.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $survey->survey_id = $_POST['survey-id'];
        $survey->survey_title = $_POST['survey-title'];
        $survey->survey_desc = $_POST['survey-desc-update-txt'];
        $survey->survey_deadline = $_POST['survey-deadline'];
        $survey->survey_status = $_POST['survey-status'];

        //update
        if ($survey->update()) {
            header("Location: aca_course_survey.php?msg=success");
        } else {
            header("Location: aca_course_survey.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['survey_id'])) {
            $survey->survey_id = $_GET['survey_id'];
            //delete
            if ($survey->delete()) {
                header("Location: aca_course_survey.php?msg=success");
            } else {
                header("Location: aca_course_survey.php?msg=delete-error");
            }
        }
    }

?>