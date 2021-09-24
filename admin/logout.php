<?php
    session_start();

    // delete all sessions
    session_destroy();
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_email']);

    header("Location: login.php");
    exit;
?>