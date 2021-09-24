<?php 

    session_start();

    //set current timezone
    date_default_timezone_set("Asia/Bangkok");
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_aca_form.php';
    
    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $form = new Form($db);

    //i = insert
    if (isset($_GET['action']) && $_GET['action'] == 'i') {
        $form->form_name = $_POST['form-name'];
        $form->form_type = $_POST['form-type'];
        $form->form_desc = $_POST['form-desc-txt'];
        $form->form_link = $_POST['form-link'];
        $form->form_date = $_POST['form-date'];
        $form->form_status = $_POST['form-status'];
        $form->created_by = $_SESSION['staff_id'];
        $form->created_date = date("Y/m/d H:i:s");

        //insert
        if ($form->create()) {
            header("Location: aca_form.php?msg=success");
        } else {
           header("Location: aca_form.php?msg=insert-error");
        }
    }

    //u = update
    if (isset($_GET['action']) && $_GET['action'] == 'u') {
        $form->form_id = $_POST['form-id'];
        $form->form_name = $_POST['form-name'];
        $form->form_type = $_POST['form-type'];
        $form->form_desc = $_POST['form-desc-update-txt'];
        $form->form_link = $_POST['form-link'];
        $form->form_date = $_POST['form-date'];
        $form->form_status = $_POST['form-status'];

        //update
        if ($form->update()) {
            header("Location: aca_form.php?msg=success");
        } else {
            header("Location: aca_form.php?msg=update-error");
        }
    }

    //d = delete
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        if (isset($_GET['form_id'])) {
            $form->form_id = $_GET['form_id'];
            //delete
            if ($form->delete()) {
                header("Location: aca_form.php?msg=success");
            } else {
                header("Location: aca_form.php?msg=delete-error");
            }
        }
    }

?>