<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_moreless_request.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $moreless_req = new Moreless_request($db);

    //i = insert
    if (isset($_POST['moreless-action']) && $_POST['moreless-action'] == 'i') {
        $moreless_req->moreless_id = $_POST['moreless-id'];
        $moreless_req->student_id = $_SESSION['std_id'];
        $moreless_req->registered_credits = $_POST['registered-credits'];
        $moreless_req->alter_registered_credits = $_POST['alter-registered-credits'];
        $moreless_req->moreless_type = $_POST['moreless-type'];
        $moreless_req->moreless_credits = $_POST['moreless-credits'];
        $moreless_req->moreless_reason = $_POST['moreless-reason'];
        $moreless_req->moreless_filename = "";
        $moreless_req->registered_date = date("Y/m/d H:i:s");
        //insert
        if ($moreless_req->create()) {
            header("Location: aca_moreless_list.php?msg=success");
        } else {
            header("Location: aca_moreless_list.php?msg=insert-error");
       }
    }

    //u = update
    if (isset($_POST['moreless-action']) && $_POST['moreless-action'] == 'u') {
        $moreless_req->moreless_id = $_POST['moreless-id'];
        $moreless_req->student_id = $_SESSION['std_id'];
        $moreless_req->registered_credits = $_POST['registered-credits'];
        $moreless_req->alter_registered_credits = $_POST['alter-registered-credits'];
        $moreless_req->moreless_type = $_POST['moreless-type'];
        $moreless_req->moreless_credits = $_POST['moreless-credits'];
        $moreless_req->moreless_reason = $_POST['moreless-reason'];
        $moreless_req->moreless_filename = "";
        //update
        if ($moreless_req->update()) {
            header("Location: aca_moreless_list.php?msg=success");
        } else {
            header("Location: aca_moreless_list.php?msg=update-error");
        }
    }

?>