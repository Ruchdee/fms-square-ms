<?php
    session_start();

    // delete all sessions
    session_destroy();
    unset($_SESSION['staff_id']);
    unset($_SESSION['staff_name']);
    unset($_SESSION['staff_email']);
    unset($_SESSION['staff_img']);
    unset($_SESSION['academic_year']);
    unset($_SESSION['semester']);
    unset($_SESSION['profile_img']);

    header("Location: login.php");
    exit;
?>