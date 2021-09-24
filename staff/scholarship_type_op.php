<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_scholarship_type.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $stype = new Scholarship_type($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $stype->scholarship_type_id = $stype->get_new_id();
        $stype->scholarship_type_name = $_POST['scholarship-type-name'];
        $stype->scholarship_type_desc = $_POST['scholarship-type-desc'];
        $stype->scholarship_type_status = $_POST['scholarship-type-status'];
        $stype->created_by = $_SESSION['staff_id'];
        $stype->created_date = date("Y/m/d H:i:s");

        //insert
        if ($stype->create()) {
            header("Location: scholarship_type.php?msg=success");
        } else {
            header("Location: scholarship_type.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $stype->scholarship_type_id = $_POST['scholarship-type-id'];
        $stype->scholarship_type_name = $_POST['scholarship-type-name'];
        $stype->scholarship_type_desc = $_POST['scholarship-type-desc'];
        $stype->scholarship_type_status = $_POST['scholarship-type-status'];
        
        //update
        if ($stype->update()) {
            header("Location: scholarship_type.php?msg=success");
        } else {
            header("Location: scholarship_type.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['scholarship_type_id'])) {
            $stype->scholarship_type_id = $_GET['scholarship_type_id'];
            //delete
            if ($stype->delete()) {
                header("Location: scholarship_type.php?msg=success");
            } else {
                header("Location: scholarship_type.php?msg=delete-error");
            }
        }
    }

?>