<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once '../php/dbconnect.php';
    include_once '../php/tb_calendar.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $calendar = new Calendar($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $calendar->calendar_title = $_POST['calendar-title'];
        $calendar->calendar_desc = $_POST['calendar-desc'];
        $calendar->start_date = $_POST['start-date'];
        $calendar->end_date = $_POST['end-date'];
        $calendar->start_time = $_POST['start-time'];
        $calendar->end_time = $_POST['end-time'];
        $calendar->calendar_owner = "S";
        $calendar->academic_year = $_SESSION['academic_year'];
        $calendar->semester = $_SESSION['semester'];
        $calendar->created_by = $_SESSION['staff_id'];
        $calendar->created_date = date("Y/m/d H:i:s");

        //insert
        if ($calendar->create()) {
            header("Location: act_calendar.php?msg=success");
        } else {
            header("Location: act_calendar.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $calendar->calendar_id = $_POST['calendar-id'];
        $calendar->calendar_title = $_POST['calendar-title-edit'];
        $calendar->calendar_desc = $_POST['calendar-desc-edit'];
        $calendar->start_date = $_POST['start-date-edit'];
        $calendar->end_date = $_POST['end-date-edit'];
        $calendar->start_time = $_POST['start-time-edit'];
        $calendar->end_time = $_POST['end-time-edit'];

        //update
        if ($calendar->update()) {
            header("Location: act_calendar.php?msg=success");
        } else {
            header("Location: act_calendar.php?msg=update-error");
        }
    }

    //ud = update event date
    if (isset($_GET['action']) && $_GET['action'] == 'ud') {
        $calendar->calendar_id = $_POST['Event'][0];
        $calendar->start_date = $_POST['Event'][1];
        $calendar->end_date = $_POST['Event'][2];

        //update
        if ($calendar->update_eventdate()) {
            //header("Location: act_calendar.php?msg=success");
            die("success");
        } else {
            //header("Location: act_calendar.php?msg=update-error");
            die("update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['calendar_id'])) {
            $calendar->calendar_id = $_GET['calendar_id'];
            //delete
            if ($calendar->delete()) {
                header("Location: act_calendar.php?msg=success");
            } else {
                header("Location: act_calendar.php?msg=delete-error");
            }
        }
    }

?>