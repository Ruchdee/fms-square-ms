<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity.php';
    include_once '../php/tb_calendar.php';               //Ruchdee 01/01/2021
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $activity = new Activity($db);
    $calendar = new Calendar($db);                      //Ruchdee 01/01/2021

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $activity->activity_name = $_POST['activity-name'];
        $activity->activity_type_id = $_POST['activity-type'];
        $activity->activity_desc = $_POST['activity-desc-txt'];
        $activity->activity_hour = $_POST['activity-hour'];
        $activity->activity_date = $_POST['activity-date'];
        $activity->academic_year = $_SESSION['academic_year'];
        $activity->activity_owner = "E";            //Educational Services - Ruchdee 11/12/2020
        $activity->activity_participant = $_POST['activity-participant'];            //Ruchdee 28/12/2020
        if (isset($_POST['activity-calendar'])) {                               //Ruchdee 01/01/2021
            $activity->activity_calendar = 1;
        } else {
            $activity->activity_calendar = 0;
        }
        $activity->activity_status = $_POST['activity-status'];
        $activity->created_by = $_SESSION['staff_id'];
        $activity->created_date = date("Y/m/d H:i:s");

        //insert
        if ($activity->create()) {
            if ($activity->activity_calendar) {
                //insert into calendar table, Ruchdee 01/01/2021 
                $calendar->calendar_title = $_POST['activity-name'];
                $calendar->calendar_desc = substr(htmlspecialchars(trim(strip_tags($_POST['activity-desc-txt']))), 0, 100);
                $calendar->start_date = $_POST['activity-date'];
                $calendar->end_date = $_POST['activity-date'];
                $calendar->start_time = date("H:i:s", strtotime("08:30:00"));
                $calendar->end_time = date("H:i:s", strtotime("16:30:00"));
                $calendar->calendar_owner = "E";
                $calendar->activity_id = mysqli_insert_id($db);
                $calendar->academic_year = $_SESSION['academic_year'];
                $calendar->semester = $_SESSION['semester'];
                $calendar->created_by = $_SESSION['staff_id'];
                $calendar->created_date = date("Y/m/d H:i:s");
                if ($calendar->create()) {
                    header("Location: aca_activity.php?msg=success");
                } else {
                    header("Location: aca_activity.php?msg=insert-error");
                }
            }
        } else {
            header("Location: aca_activity.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $activity->activity_id = $_POST['activity-id'];
        $activity->activity_name = $_POST['activity-name'];
        $activity->activity_type_id = $_POST['activity-type'];
        $activity->activity_desc = $_POST['activity-desc-update-txt'];
        $activity->activity_hour = $_POST['activity-hour'];
        $activity->activity_date = $_POST['activity-date'];
        $activity->activity_participant = $_POST['activity-participant'];            //Ruchdee 28/12/2020
        if (isset($_POST['activity-calendar'])) {                               //Ruchdee 01/01/2021
            $activity->activity_calendar = 1;
            //check already exists?
            $calendar->activity_id = $_POST['activity-id'];
            $result_exist = $calendar->readonebyactivity();
            if (mysqli_num_rows($result_exist) == 0) {
                //if not exist, insert into calendar table
                $calendar->calendar_title = $_POST['activity-name'];
                $calendar->calendar_desc = substr(htmlspecialchars(trim(strip_tags($_POST['activity-desc-update-txt']))), 0, 100);
                //$calendar->calendar_desc = "Test";
                $calendar->start_date = $_POST['activity-date'];
                $calendar->end_date = $_POST['activity-date'];
                $calendar->start_time = date("H:i:s", strtotime("08:30:00"));
                $calendar->end_time = date("H:i:s", strtotime("16:30:00"));
                $calendar->calendar_owner = "E";
                $calendar->activity_id = $_POST['activity-id'];
                $calendar->academic_year = $_SESSION['academic_year'];
                $calendar->semester = $_SESSION['semester'];
                $calendar->created_by = $_SESSION['staff_id'];
                $calendar->created_date = date("Y/m/d H:i:s");
                if ($calendar->create()) {
                } else {
                    header("Location: aca_activity.php?msg=update-error");
                    exit;
                }
            } else {
                //if exists, update calendar table
                $calendar->calendar_title = $_POST['activity-name'];
                $calendar->calendar_desc = substr(htmlspecialchars(trim(strip_tags($_POST['activity-desc-update-txt']))), 0, 100);
                //$calendar->calendar_desc = "Test";
                $calendar->start_date = $_POST['activity-date'];
                $calendar->end_date = $_POST['activity-date'];
                $calendar->activity_id = $_POST['activity-id'];
                if ($calendar->updatebyactivity()) {
                } else {
                    header("Location: aca_activity.php?msg=update-error");
                    exit;
                }
            }
        } else {
            $activity->activity_calendar = 0;
            //check already exists?
            $calendar->activity_id = $_POST['activity-id'];
            $result_exist = $calendar->readonebyactivity();
            if (mysqli_num_rows($result_exist) > 0) {
                //if exists, remove from calendar table
                if ($calendar->deletebyactivity()) {
                } else {
                    header("Location: aca_activity.php?msg=update-error");
                    exit;
                }
            }
        }
        $activity->activity_status = $_POST['activity-status'];

        //update
        if ($activity->update()) {
            header("Location: aca_activity.php?msg=success");
        } else {
            header("Location: aca_activity.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['activity_id'])) {
            $activity->activity_id = $_GET['activity_id'];
            //delete
            if ($activity->delete()) {
                //check already exists?, Ruchdee 01/01/2021 
                $calendar->activity_id = $_GET['activity_id'];
                $result_exist = $calendar->readonebyactivity();
                if (mysqli_num_rows($result_exist) > 0) {
                    //if exists, remove from calendar table
                    if ($calendar->deletebyactivity()) {
                        header("Location: aca_activity.php?msg=success");
                    } else {
                        header("Location: aca_activity.php?msg=delete-error");
                        exit;
                    }
                }
            } else {
                header("Location: aca_activity.php?msg=delete-error");
            }
        }
    }

?>