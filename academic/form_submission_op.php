<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

     //upload file
    //file types allow to upload
    $file_type_allow = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    //max file size - 5M
    $max_file_size = 5000000;

    if($_FILES['fsubmission-filename']['name'] != '') {    
        if (in_array($_FILES['fsubmission-filename']['type'], $file_type_allow)) {
            if ($_FILES['fsubmission-filename']['size'] <= $max_file_size) {
                //get random number for file name
                $numrand = (mt_rand());
                //upload folder
                $upload_dir = "../assets/files/upload/";
                //get file type
                $file_type = strrchr($_FILES['fsubmission-filename']['name'], ".");
                //get new file name
                //add student id to file name, 21/07/2021 Aj.Ruchdee
                $new_name = $_SESSION['std_id'] . "_" . date("Ymd") . $numrand . $file_type;
                $path_copy = $upload_dir . $new_name;
                //start upload file
                move_uploaded_file($_FILES['fsubmission-filename']['tmp_name'], $path_copy);
            } else {
                header("Location: form_submission.php?msg=fsize-error");
                exit;
            }
        } else {
            header("Location: form_submission.php?msg=ftype-error");
            exit;
        }
    } 
    
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

    //get form name
    $forms->form_id = $_POST['form_id'];
    $result_form = $forms->readone();
    $row_form = mysqli_fetch_array($result_form);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $fsubmission->form_id = $_POST['form_id'];
        $fsubmission->std_id = $_SESSION['std_id'];
        $fsubmission->fsubmission_date = date("Y/m/d H:i:s");
        $fsubmission->fsubmission_remark = $_POST['fsubmission-remark'];
        $fsubmission->fsubmission_filename = $path_copy;
        $fsubmission->fsubmission_email = $_POST['fsubmission-email'];          //May 30, 2021 Aj.Ruchdee
        $fsubmission->fsubmission_status = "1";
        $fsubmission->academic_year = $_SESSION['academic_year'];
        $fsubmission->semester = $_SESSION['semester'];
        $fsubmission->form_name = $row_form['form_name'];                       //May 30, 2021 Aj.Ruchdee

        //sending email to student and staff, May 30, 2021 Aj.Ruchdee
        if (!$fsubmission->send_email_student()) {
            header("Location: form_submission.php?msg=email-error");
        }
        if (!$fsubmission->send_email_staff()) {
            header("Location: form_submission.php?msg=email-error");
        }

        //insert
        if ($fsubmission->create()) {
            //insert into fsubmission_logs, June 3, 2021 Aj.Ruchdee
            $fsubmission_logs->fsubmission_id = mysqli_insert_id($db);
            $fsubmission_logs->fsubmission_log_status = "1";
            $fsubmission_logs->fsubmission_log_remark = "";
            $fsubmission_logs->created_by = $_SESSION['std_id'];
            $fsubmission_logs->created_date = date("Y/m/d H:i:s");
            if ($fsubmission_logs->create()) {
                header("Location: form_submission.php?msg=success");
            } else {
                header("Location: form_submission.php?msg=insert-error");
            }
        } else {
            header("Location: form_submission.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $fsubmission->fsubmission_id = $_POST['fsubmission-id'];
        $fsubmission->form_id = $_POST['form_id'];
        $fsubmission->fsubmission_remark = $_POST['fsubmission-remark'];
        $fsubmission->fsubmission_filename = $path_copy;
        $fsubmission->fsubmission_email = $_POST['fsubmission-email'];          //May 30, 2021 Aj.Ruchdee

        //update
        if ($fsubmission->update()) {
           header("Location: form_submission.php?msg=success");
       } else {
            header("Location: form_submission.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['fsubmission_id'])) {
            $fsubmission->fsubmission_id = $_GET['fsubmission_id'];
            //delete
            if ($fsubmission->delete()) {
                header("Location: form_submission.php?msg=success");
            } else {
                header("Location: form_submission.php?msg=delete-error");
            }
        }
    }

?>