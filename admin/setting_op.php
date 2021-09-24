<?php 
    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_setting.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $setting = new Setting($db);

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $setting->academic_year = $_POST['academic-year'];
        $setting->semester = $_POST['semester'];
        $setting->updated_by = $_SESSION['admin_id'];
        $setting->updated_date = date("Y/m/d H:i:s");
        
        //update
        if ($setting->update()) {
            header("Location: setting.php?msg=success");
        } else {
            header("Location: setting.php?msg=error");
        }
    }

?>