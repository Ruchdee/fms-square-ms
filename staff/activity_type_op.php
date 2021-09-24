<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity_type.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $stype = new Activity_type($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $stype->activity_type_id = $stype->get_new_id();
        $stype->activity_type_name = $_POST['activity-type-name'];
        $stype->activity_type_desc = $_POST['activity-type-desc'];
        $stype->activity_type_owner = "S";      //Student Affairs - Ruchdee 11/12/2020
        $stype->activity_type_status = $_POST['activity-type-status'];
        $stype->created_by = $_SESSION['staff_id'];
        $stype->created_date = date("Y/m/d H:i:s");

        //insert
        if ($stype->create()) {
            header("Location: activity_type.php?msg=success");
        } else {
            header("Location: activity_type.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $stype->activity_type_id = $_POST['activity-type-id'];
        $stype->activity_type_name = $_POST['activity-type-name'];
        $stype->activity_type_desc = $_POST['activity-type-desc'];
        $stype->activity_type_status = $_POST['activity-type-status'];
        
        //update
        if ($stype->update()) {
            header("Location: activity_type.php?msg=success");
        } else {
            header("Location: activity_type.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['activity_type_id'])) {
            $stype->activity_type_id = $_GET['activity_type_id'];
            //delete
            if ($stype->delete()) {
                header("Location: activity_type.php?msg=success");
            } else {
                header("Location: activity_type.php?msg=delete-error");
            }
        }
    }

?>