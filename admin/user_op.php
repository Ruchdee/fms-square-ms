<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    //upload file
    //file types allow to upload
    $file_type_allow = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
    //max file size - 5M
    $max_file_size = 5000000;

    if($_FILES['user-img']['name'] != '') {
        if (in_array($_FILES['user-img']['type'], $file_type_allow)) {
            if ($_FILES['user-img']['size'] <= $max_file_size) {
                //get random number for file name
                $numrand = (mt_rand());
                //upload folder
                $upload_dir = "../assets/images/upload/users/";
                //get file type
                $file_type = strrchr($_FILES['user-img']['name'], ".");
                //get new file name
                $new_name = date("Ymd") . $numrand . $file_type;
                $path_copy = $upload_dir . $new_name;
                //start upload file
                move_uploaded_file($_FILES['user-img']['tmp_name'], $path_copy);
            } else {
                header("Location: user.php?msg=fsize-error");
                exit;
            }
        } else {
            header("Location: user.php?msg=ftype-error");
            exit;
        }
    } else {
        $path_copy = $_POST['user-img-old'];
    }
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_user.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $user = new User($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $user->user_id = $_POST['user-id'];
        $user->user_name = $_POST['user-name'];
        $user->user_type = $_POST['user-type'];
        $user->user_img = $path_copy;
        $user->user_status = $_POST['user-status'];
        $user->created_by = $_SESSION['admin_id'];
        $user->created_date = date("Y/m/d H:i:s");

        //insert
        if ($user->create()) {
            header("Location: user.php?msg=success");
        } else {
            header("Location: user.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $user->user_id = $_POST['user-id'];
        $user->user_name = $_POST['user-name'];
        $user->user_type = $_POST['user-type'];
        $user->user_img = $path_copy;
        $user->user_status = $_POST['user-status'];
        
        //update
        if ($user->update()) {
            header("Location: user.php?msg=success");
        } else {
            header("Location: user.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['user_id'])) {
            $user->user_id = $_GET['user_id'];
            //delete
            if ($user->delete()) {
                header("Location: user.php?msg=success");
            } else {
                header("Location: user.php?msg=delete-error");
            }
        }
    }


?>