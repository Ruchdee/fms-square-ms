<?php
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    //upload file
    //file types allow to upload
    $file_type_allow = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
    //max file size - 5M
    $max_file_size = 5000000;

    if($_FILES['lecturer-img']['name'] != '') {    
        if (in_array($_FILES['lecturer-img']['type'], $file_type_allow)) {
            if ($_FILES['lecturer-img']['size'] <= $max_file_size) {
                //get random number for file name
                $numrand = (mt_rand());
                //upload folder
                $upload_dir = "../assets/images/upload/lecturers/";
                //get file type
                $file_type = strrchr($_FILES['lecturer-img']['name'], ".");
                //get new file name
                $new_name = date("Ymd") . $numrand . $file_type;
                $path_copy = $upload_dir . $new_name;
                //start upload file
                move_uploaded_file($_FILES['lecturer-img']['tmp_name'], $path_copy);
            } else {
                header("Location: lecturer_profile.php?msg=fsize-error");
                exit;
            }
        } else {
            header("Location: lecturer_profile.php?msg=ftype-error");
            exit;
        }
    } else {
        $path_copy = $_POST['lecturer-img-old'];
    }
    
    //save into database
    include_once '../php/dbconnect.php';
    include_once '../php/tb_lecturer.php';
    
    //get connection
    $database = new Database();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $lecturer = new Lecturer($db_m);

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $lecturer->lecturer_id = $_SESSION['lecturer_id'];
        $lecturer->lecturer_email = $_POST['lecturer-email'];
        $lecturer->lecturer_phone = $_POST['lecturer-phone'];
        $lecturer->lecturer_remark = $_POST['lecturer-remark'];
        $lecturer->lecturer_img = $path_copy;
        
        //update
        if ($lecturer->update_lecturer_profile()) {
            //update sessions
            $_SESSION['lecturer_email'] = $_POST['lecturer-email'];
            $_SESSION['lecturer_img'] = $path_copy;
            header("Location: lecturer_profile.php?msg=update-success");
        } else {
            header("Location: lecturer_profile.php?msg=update-error");
        }
    }

?>