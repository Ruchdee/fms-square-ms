<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_scholarship.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $scholarship = new Scholarship($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $scholarship->scholarship_name = $_POST['scholarship-name'];
        $scholarship->scholarship_type_id = $_POST['scholarship-type'];
        $scholarship->scholarship_desc = $_POST['scholarship-desc-txt'];
        $scholarship->scholarship_date = $_POST['scholarship-date'];
        $scholarship->scholarship_status = $_POST['scholarship-status'];
        $scholarship->created_by = $_SESSION['staff_id'];
        $scholarship->created_date = date("Y/m/d H:i:s");

        //insert
        if ($scholarship->create()) {
            header("Location: scholarship.php?msg=success");
        } else {
            header("Location: scholarship.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $scholarship->scholarship_id = $_POST['scholarship-id'];
        $scholarship->scholarship_name = $_POST['scholarship-name'];
        $scholarship->scholarship_type_id = $_POST['scholarship-type'];
        $scholarship->scholarship_desc = $_POST['scholarship-desc-update-txt'];
        $scholarship->scholarship_date = $_POST['scholarship-date'];
        $scholarship->scholarship_status = $_POST['scholarship-status'];

        //update
        if ($scholarship->update()) {
            header("Location: scholarship.php?msg=success");
        } else {
            header("Location: scholarship.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['scholarship_id'])) {
            $scholarship->scholarship_id = $_GET['scholarship_id'];
            //delete
            if ($scholarship->delete()) {
                header("Location: scholarship.php?msg=success");
            } else {
                header("Location: scholarship.php?msg=delete-error");
            }
        }
    }

?>