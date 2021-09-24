<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once '../php/dbconnect.php';
    include_once '../php/tb_news.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $news = new News($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $news->news_title = $_POST['news-title'];
        $news->news_desc = $_POST['news-desc'];
        $news->news_type = $_POST['news-type'];
        $news->news_owner = "S";
        $news->news_date = $_POST['news-date'];
        $news->news_status = $_POST['news-status'];
        $news->academic_year = $_SESSION['academic_year'];
        $news->semester = $_SESSION['semester'];
        $news->created_by = $_SESSION['staff_id'];
        $news->created_date = date("Y/m/d H:i:s");

        //insert
        if ($news->create()) {
            header("Location: act_news.php?msg=success");
        } else {
            header("Location: act_news.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $news->news_id = $_POST['news-id'];
        $news->news_title = $_POST['news-title'];
        $news->news_desc = $_POST['news-desc-update'];
        $news->news_type = $_POST['news-type'];
        $news->news_date = $_POST['news-date'];
        $news->news_status = $_POST['news-status'];

        //insert
        if ($news->update()) {
            header("Location: act_news.php?msg=success");
        } else {
            header("Location: act_news.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['news_id'])) {
            $news->news_id = $_GET['news_id'];
            //delete
            if ($news->delete()) {
                header("Location: act_news.php?msg=success");
            } else {
                header("Location: act_news.php?msg=delete-error");
            }
        }
    }

?>