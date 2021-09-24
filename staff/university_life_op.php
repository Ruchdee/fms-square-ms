<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    //upload file
    //file types allow to upload
    $file_type_allow = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
    //max file size - 5M
    $max_file_size = 5000000;

    if($_FILES['article-img']['name'] != '') {    
        if (in_array($_FILES['article-img']['type'], $file_type_allow)) {
            if ($_FILES['article-img']['size'] <= $max_file_size) {
                //get random number for file name
                $numrand = (mt_rand());
                //upload folder
                $upload_dir = "../assets/images/upload/";
                //get file type
                $file_type = strrchr($_FILES['article-img']['name'], ".");
                //get new file name
                $new_name = date("Ymd") . $numrand . $file_type;
                $path_copy = $upload_dir . $new_name;
                //start upload file
                move_uploaded_file($_FILES['article-img']['tmp_name'], $path_copy);
            } else {
                header("Location: university_life.php?msg=fsize-error");
                exit;
            }
        } else {
            header("Location: lecturer_profile.php?msg=ftype-error");
            exit;
        }
    } else {
        $path_copy = "";
    }

    include_once '../php/dbconnect.php';
    include_once '../php/tb_university_life.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $ulife = new University_life($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $ulife->article_name = $_POST['article-name'];
        $ulife->article_desc = $_POST['article-desc'];
        $ulife->article_date = $_POST['article-date'];
        $ulife->article_img = $path_copy;
        $ulife->article_status = $_POST['article-status'];
        $ulife->article_by = $_POST['article-by'];
        $ulife->created_by = $_SESSION['staff_id'];
        $ulife->created_date = date("Y/m/d H:i:s");

        //insert
        if ($ulife->create()) {
            header("Location: university_life.php?msg=success");
        } else {
            header("Location: university_life.php?msg=insert-error");
        }
    }

    //i = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $ulife->article_id = $_POST['article-id'];
        $ulife->article_name = $_POST['article-name'];
        $ulife->article_desc = $_POST['article-desc-update'];
        $ulife->article_date = $_POST['article-date'];
        $ulife->article_img = $path_copy;
        $ulife->article_status = $_POST['article-status'];
        $ulife->article_by = $_POST['article-by'];

        //update
        if ($ulife->update()) {
            header("Location: university_life.php?msg=success");
        } else {
            header("Location: university_life.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['article_id'])) {
            $ulife->article_id = $_GET['article_id'];
            //delete
            if ($ulife->delete()) {
                header("Location: university_life.php?msg=success");
            } else {
                header("Location: university_life.php?msg=delete-error");
            }
        }
    }

?>