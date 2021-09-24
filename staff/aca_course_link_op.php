<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_link.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $clink_update = new Course_link($db);
    $clink_update->section_offer_id = $_POST['section-offer-id'];
    $clink_update->lecturer_pers_id = $_POST['lecturer-id'];
    $clink_update->course_url = $_POST['course-url'];
    if (isset($_POST['course-url-other'])) {
        $clink_update->course_url_other = $_POST['course-url-other'];
    } else {
        $clink_update->course_url_other = "";
    }
    $clink_update->invite_url = $_POST['invite-url'];
    $clink_update->invite_code = $_POST['invite-code'];
    $clink_update->other_remark = $_POST['other-remark'];
    $clink_update->created_by = $_SESSION['staff_id'];
    $clink_update->created_date = date("Y/m/d H:i:s");

    $resut = $clink_update->readoneforstaff();
    if (mysqli_fetch_array($resut)) {
        //update
        if ($clink_update->updateforstaff()) {
            header("Location: aca_course_link.php?msg=success");
        } else {
            header("Location: aca_course_link.php?msg=update-error");
        }
    } else {
        //insert        
        if ($clink_update->create()) {
            header("Location: aca_course_link.php?msg=success");
        } else {
            header("Location: aca_course_link.php?msg=insert-error");
        }
    }
    
?>