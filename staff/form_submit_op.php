<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_form_submission.php';
    include_once '../php/tb_aca_form.php';
    include_once '../php/tb_fsubmission_log.php';       //June 3, 2021 Aj.Ruchdee
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $fsubmission = new Form_submission($db);
    $forms = new Form($db);
    $fsubmission_logs = new Form_submission_log($db);       //June 3, 2021 Aj.Ruchdee

    $fsubmission->fsubmission_id = $_POST['fsubmission-id'];
    //get submission details
    $result = $fsubmission->readone();
    $row = mysqli_fetch_array($result);
    $fsubmission->std_id = $row['student_id'];
    $fsubmission->fsubmission_date = $row['fsubmission_date'];

    //get form name
    $forms->form_id = $row['form_id'];
    $result_form = $forms->readone();
    $row_form = mysqli_fetch_array($result_form);
    $fsubmission->form_name = $row_form['form_name']; 

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $fsubmission->fsubmission_remark = $_POST['fsubmission-remark'];
        $fsubmission->fsubmission_status = $_POST['fsubmission-status'];
        $fsubmission->fsubmission_email = $row['fsubmission_email'];

        //sending email to student and staff, May 30, 2021 Aj.Ruchdee
        if (!$fsubmission->send_email_student()) {
            header("Location: form_submit_list.php?msg=email-error");
        }
        
        //update
        if ($fsubmission->update_status()) {
            //insert into fsubmission_logs, June 3, 2021 Aj.Ruchdee
            $fsubmission_logs->fsubmission_id = $_POST['fsubmission-id'];
            $fsubmission_logs->fsubmission_log_status = $_POST['fsubmission-status'];
            $fsubmission_logs->fsubmission_log_remark = "";
            $fsubmission_logs->created_by = $_SESSION['staff_id'];
            $fsubmission_logs->created_date = date("Y/m/d H:i:s");
            if ($fsubmission_logs->create()) {
                header("Location: form_submit_list.php?msg=success");
            } else {
                header("Location: form_submit_list.php?msg=update-error");
            }
        } else {
            header("Location: form_submit_list.php?msg=update-error");
        }
    }

    //f = forward
    if (isset($_GET['action']) && $_GET['action'] == 'f') {
        $fsubmission->fsubmission_filename = $row['fsubmission_filename'];
        $fsubmission->fsubmission_status = $row['fsubmission_status'];
        $fsubmission->lecturer_email = $_POST['forward-email'];
        $fsubmission->lecturer_type = $_POST['lecturer-type'];
        $fsubmission->forward_email2 = $_POST['forward-email2'];
        $fsubmission->forward_email3 = $_POST['forward-email3'];

        //sending email to student and staff, May 30, 2021 Aj.Ruchdee
        if (!$fsubmission->send_email_lecturer()) {
            header("Location: form_submit_list.php?msg=email-error");
        }

        //insert into fsubmission_logs, June 3, 2021 Aj.Ruchdee
        $fsubmission_logs->fsubmission_id = $_POST['fsubmission-id'];
        $fsubmission_logs->fsubmission_log_status = "6";
        $fsubmission_logs->fsubmission_log_remark = $_POST['forward-email'];
        $fsubmission_logs->created_by = $_SESSION['staff_id'];
        $fsubmission_logs->created_date = date("Y/m/d H:i:s");
        if ($fsubmission_logs->create()) {
            header("Location: form_submit_list.php?msg=success");
        } else {
            header("Location: form_submit_list.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['fsubmission_id'])) {
            $fsubmission->fsubmission_id = $_GET['fsubmission_id'];
            //delete
            if ($fsubmission->delete()) {
                //insert into fsubmission_logs, June 3, 2021 Aj.Ruchdee
                $fsubmission_logs->fsubmission_id = $_GET['fsubmission_id'];
                $fsubmission_logs->fsubmission_log_status = "7";
                $fsubmission_logs->fsubmission_log_remark = "";
                $fsubmission_logs->created_by = $_SESSION['staff_id'];
                $fsubmission_logs->created_date = date("Y/m/d H:i:s");
                if ($fsubmission_logs->create()) {
                    header("Location: form_submit_list.php?msg=success");
                } else {
                    header("Location: form_submit_list.php?msg=delete-error");
                }
            } else {
                header("Location: form_submit_list.php?msg=delete-error");
            }
        }
    }

?>