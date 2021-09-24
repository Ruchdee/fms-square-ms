<?php
    session_start();

    // delete all sessions
    session_destroy();
    unset($_SESSION['lecturer_id']);
    unset($_SESSION['lecturer_ppid']);
    unset($_SESSION['lecturer_name']);
    unset($_SESSION['lecturer_email']);
    unset($_SESSION['lecturer_img']);
    unset($_SESSION['lecturer_id_card']);           //modified 25/10/2020 Ruchdee
    unset($_SESSION['academic_year']);
    unset($_SESSION['semester']);

    header("Location: login.php");
    exit;
?>