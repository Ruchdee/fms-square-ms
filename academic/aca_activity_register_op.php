<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity_register.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $activity_register = new Activity_regitser($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $activity_register->activity_id = $_GET['activity_id'];
        $activity_register->student_id = $_SESSION['std_id'];
        $activity_register->registered_date = date("Y/m/d H:i:s");
        //insert
        if ($activity_register->create()) {
            header("Location: aca_activity_list.php?msg=success");
        } else {
            header("Location: aca_activity_list.php?msg=insert-error");
       }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $activity_register->activity_id = $_SESSION['activity_id'];
        $activity_register->stu_id = $_SESSION['std_id'];
       
        //update
        if ($activity_register->update()) {
            header("Location: aca_activity_list.php?msg=success");
        } else {
            header("Location: aca_activity_list.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['activity_id'])) {
            $activity_register->activity_id = $_GET['activity_id'];
            $activity_register->student_id = $_SESSION['std_id'];
            //delete
            if ($activity_register->delete()) {
                header("Location: aca_activity_list.php?msg=success");
            } else {
                header("Location: aca_activity_list.php?msg=delete-error");
            }
        }
    }

?>