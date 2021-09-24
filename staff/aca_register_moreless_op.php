<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_register_moreless.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $moreless = new Register_moreless($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $moreless->moreless_title = $_POST['moreless-title'];
        $moreless->moreless_desc = $_POST['moreless-desc-txt'];
        $moreless->moreless_deadline = $_POST['moreless-deadline'];
        $moreless->moreless_status = $_POST['moreless-status'];
        $moreless->academic_year = $_SESSION['academic_year'];
        $moreless->semester = $_SESSION['semester'];
        $moreless->created_by = $_SESSION['staff_id'];
        $moreless->created_date = date("Y/m/d H:i:s");

        //insert
        if ($moreless->create()) {
            header("Location: aca_register_moreless.php?msg=success");
        } else {
           header("Location: aca_register_moreless.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $moreless->moreless_id = $_POST['moreless-id'];
        $moreless->moreless_title = $_POST['moreless-title'];
        $moreless->moreless_desc = $_POST['moreless-desc-update-txt'];
        $moreless->moreless_deadline = $_POST['moreless-deadline'];
        $moreless->moreless_status = $_POST['moreless-status'];

        //update
        if ($moreless->update()) {
            header("Location: aca_register_moreless.php?msg=success");
        } else {
            header("Location: aca_register_moreless.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['moreless_id'])) {
            $moreless->moreless_id = $_GET['moreless_id'];
            //delete
            if ($moreless->delete()) {
                header("Location: aca_register_moreless.php?msg=success");
            } else {
                header("Location: aca_register_moreless.php?msg=delete-error");
            }
        }
    }

?>