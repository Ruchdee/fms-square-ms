<?php 
    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    //upload file
    if($_FILES['profile_img']['name'] != '') {    
        //file types allow to upload
        $file_type_allow = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
        //max file size - 5M
        $max_file_size = 5000000;
        if (in_array($_FILES['profile_img']['type'], $file_type_allow)) {
            if ($_FILES['profile_img']['size'] <= $max_file_size) {
                //get random number for file name
                $numrand = (mt_rand());
                //upload folder
                $upload_dir = "../assets/images/upload/students/";
                //get file type
                $file_type = strrchr($_FILES['profile_img']['name'], ".");
                //get new file name
                $new_name = date("Ymd") . $numrand . $file_type;
                $path_copy = $upload_dir . $new_name;
                //start upload file
                move_uploaded_file($_FILES['profile_img']['tmp_name'], $path_copy);
            } else {
                //exceed max_file_size
                header("Location: student_profile.php?msg=fsize-error");
                exit;
            }
        } else {
            //not image file
            header("Location: student_profile.php?msg=ftype-error");
            exit;
        }
    } else {
        $path_copy = $_POST['profile-img-old'];
    }

    include_once '../php/dbconnect.php';
    include_once '../php/tb_student_profile.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection_main();
    //pass connection to table
    $std = new Studentp($db);

    //u = update
    if (isset($_REQUEST['update']) && $_GET['action'] == 'u') {
        $std->student_id = $_REQUEST['student_id'];
        $std->phone = $_REQUEST['phone'];
        $std->mobile = $_REQUEST['mobile'];
        $std->email = $_REQUEST['email'];
        $std->facebook_id = $_REQUEST['facebook_id'];
        $std->line_id = $_REQUEST['line_id'];
        $std->twitter_id = $_REQUEST['twitter_id'];
        $std->youtube_id = $_REQUEST['youtube_id'];
        $std->profile_img = $path_copy;

        //update
        if ($std->update()) {
            //update sessions
            $_SESSION['std_email'] = $_REQUEST['email'];
            $_SESSION['profile_img'] = $path_copy;
            header("Location: student_profile.php?msg=update-success");
        } else {
            header("Location: student_profile.php?msg=update-error");
        }
    }

?>
