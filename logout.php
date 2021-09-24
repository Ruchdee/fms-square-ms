<?php
    session_start();

    // delete all sessions
    session_destroy();
    unset($_SESSION['std_id']);
    unset($_SESSION['std_name']);
    unset($_SESSION['std_email']);
    unset($_SESSION['profile_img']);
    unset($_SESSION['academic_year']);
    unset($_SESSION['semester']);
    unset($_SESSION['std_id_card']);            //Jul 7, 2021 Aj.Ruchdee

    header("Location: login.php");
    exit;
?>