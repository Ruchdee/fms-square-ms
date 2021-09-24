<?php 
    session_start();

    //set current timezone 
    date_default_timezone_set("Asia/Bangkok");

    include_once '../php/dbconnect.php';
    include_once '../php/tb_message_list.php';
    include_once '../php/tb_user.php';
    include_once '../php/tb_setting.php';
    include_once '../php/tb_student_profile.php';

    //get connect
    $database = new Database();
    $db = $database->getConnection();
    $db_main = $database->getConnection_main();

    //pass connection to table
    $mlist = new Message_list($db, $db_main);
    //get all user
    $student = new Studentp($db_main);

    //get academic_year & semester
    $setting = new Setting($db);
    $result_setting = $setting->readone();
    $row_setting = mysqli_fetch_array($result_setting);

    //search and send message private
    if (isset($_POST['p_search']) || isset($_POST['p_custom_search'])) {
        $mlist->to_user_id = $_POST['to_user_id'];
        if ($mlist->check_user()) {
            $mlist->msg_text = $_POST['msg_text'];
            $mlist->msg_text = str_replace("'", "\'", $mlist->msg_text);
            $mlist->msg_type = "p";
            if (isset($_SESSION['admin_id'])) {
                $mlist->from_user_id = $_SESSION['admin_id'];
            } elseif (isset($_SESSION['lecturer_ppid'])) {
                $mlist->from_user_id = $_SESSION['lecturer_ppid'];
            } elseif (isset($_SESSION['std_id'])) {
                $mlist->from_user_id = $_SESSION['std_id'];
            } elseif(isset($_SESSION['staff_id'])) {
                $mlist->from_user_id = $_SESSION['staff_id'];
            }
            $mlist->msg_read = 0;
            $mlist->msg_date = date("Y/m/d H:i:s");
            $mlist->academic_year = $row_setting['academic_year'];
            $mlist->semester = $row_setting['semester'];
            //$mlist->chat_message();
            if ($mlist->chat_message()) {
                header('Location: message_list.php');
            } else {
                header('Location: message_list.php?msg=insert-error');
            }
        } else {
            header('Location: message_list.php?msg=error');
        }
    }

    //search and send group message
    if(isset($_POST['g_search'])){
        $year_status = $_POST['year_status'];
        $majors = $_POST['majors'];
        $all_student = $student->get_all_students_lect($year_status, $majors);
        while($row = mysqli_fetch_array($all_student)) {
            $users[] = $row['student_id'];
        }
        $mlist->msg_text = $_POST['g_msg_text'];
        $mlist->msg_text = str_replace("'", "\'", $mlist->msg_text);
        $mlist->msg_type = "g";
        if (isset($_SESSION['admin_id'])) {
            $mlist->from_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->from_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->from_user_id = $_SESSION['std_id'];
        } elseif(isset($_SESSION['staff_id'])) {
            $mlist->from_user_id = $_SESSION['staff_id'];
        }
        $mlist->to_user_id = $users;
        $mlist->msg_read = 0;
        $mlist->msg_date = date("Y/m/d H:i:s");
        $mlist->academic_year = $row_setting['academic_year'];
        $mlist->semester = $row_setting['semester'];
        $mlist->group_chat_message();
        header('Location: message_list.php');
        exit;
    }

    //send message
    if(isset($_POST['action']) && $_POST['action'] == "p") {
        $mlist->msg_text= $_POST['msg_text'];
        $string = array("'","/\\");
        $replace = array("\'","/\\\\");
        $mlist->msg_text = str_replace($string,$replace,$mlist->msg_text);
        $mlist->msg_type = "p";
        if (isset($_SESSION['admin_id'])) {
            $mlist->from_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->from_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->from_user_id = $_SESSION['std_id'];
        } elseif (isset($_SESSION['staff_id'])) {
            $mlist->from_user_id = $_SESSION['staff_id'];
        }
        $mlist->to_user_id = $_POST['to_user_id'];
        $mlist->msg_read = 0;
        $mlist->msg_date = date("Y/m/d H:i:s");
        $mlist->academic_year = $row_setting['academic_year'];
        $mlist->semester = $row_setting['semester'];
        if ($mlist->chat_message()) {
            echo $mlist->get_chat_history($mlist->from_user_id, $mlist->to_user_id);
        } else {
            echo 'Use double';
        }
    }

    //send message base on checked student (student_list.php)
    if(isset($_POST['send_chk_student'])) {
        if (isset($_SESSION['admin_id'])) {
            $mlist->from_user_id = $_SESSION['admin_id'];
        } elseif(isset($_SESSION['lecturer_ppid'])) {
            $mlist->from_user_id = $_SESSION['lecturer_ppid'];
        } elseif(isset($_SESSION['std_id'])) {
            $mlist->from_user_id = $_SESSION['std_id'];
        } elseif(isset($_SESSION['staff_id'])) {
            $mlist->from_user_id = $_SESSION['staff_id'];
        }
        $user = explode(',', $_POST['multi_to_user_id']);
        foreach($user as $us) {
            $users[] = $us;
        }
        $mlist->to_user_id = $users;
        $mlist->msg_type = 'g';
        $mlist->msg_text = $_POST['chk_msg_text'];
        $mlist->msg_text = str_replace("'", "\'", $mlist->msg_text);
        $mlist->msg_read = 0;
        $mlist->msg_date = date("Y/m/d H:i:s");
        $mlist->academic_year = $row_setting['academic_year'];
        $mlist->semester = $row_setting['semester'];
        $mlist->group_chat_message();
        header("location: message_list.php?msg=success");
        exit;
    }

    //get chat history
    if(isset($_POST['get_chat_history'])){
        $mlist->to_user_id = $_POST['to_user_id'];
        if (isset($_SESSION['admin_id'])) {
            $mlist->from_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->from_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->from_user_id = $_SESSION['std_id'];
        } elseif (isset($_SESSION['staff_id'])) {
            $mlist->from_user_id = $_SESSION['staff_id'];
        }
        echo $mlist->get_chat_history();
    }

    //get current user
    if(isset($_POST['get_current_user'])) {
        if (isset($_SESSION['admin_id'])) {
            $mlist->from_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->from_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->from_user_id = $_SESSION['std_id'];
        } elseif (isset($_SESSION['staff_id'])) {
            $mlist->from_user_id = $_SESSION['staff_id'];
        }
        echo $mlist->get_current_user();
    }

    //show notify red dot
    if(isset($_POST['show_notify_red_dot'])) {
        if (isset($_SESSION['admin_id'])) {
            $mlist->to_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->to_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->to_user_id = $_SESSION['std_id'];
        } elseif (isset($_SESSION['staff_id'])) {
            $mlist->to_user_id = $_SESSION['staff_id'];
        }
        echo $mlist->show_notify_red_dot();
    }

    //count unread message
    if(isset($_POST['count_unread_message'])) {
        if (isset($_SESSION['admin_id'])) {
            $mlist->to_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->to_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->to_user_id = $_SESSION['std_id'];
        } elseif (isset($_SESSION['staff_id'])) {
            $mlist->to_user_id = $_SESSION['staff_id'];
        }
        echo $mlist->count_unread_message();
    }

    //update read message
    if(isset($_POST['update_read_message'])) {
        if (isset($_SESSION['admin_id'])) {
            $mlist->to_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->to_user_id = $_SESSION['lecturer_ppid'];
        } elseif(isset($_SESSION['std_id'])) {
            $mlist->to_user_id = $_SESSION['std_id'];
        } elseif (isset($_SESSION['staff_id'])) {
            $mlist->to_user_id = $_SESSION['staff_id'];
        }
        $mlist->from_user_id = $_POST['from_user_id'];
        if ($mlist->update_read_message()) {
            return true;
        } else {
            return false;
        }
    }

    //update notify chat
    if(isset($_POST['notify_last4_chat'])) {
        if (isset($_SESSION['admin_id'])) {
            $mlist->to_user_id = $_SESSION['admin_id'];
        } elseif (isset($_SESSION['lecturer_ppid'])) {
            $mlist->to_user_id = $_SESSION['lecturer_ppid'];
        } elseif (isset($_SESSION['std_id'])) {
            $mlist->to_user_id = $_SESSION['std_id'];
        } elseif(isset($_SESSION['staff_id'])) {
            $mlist->to_user_id = $_SESSION['staff_id'];
        }
        echo $mlist->notify_last4_chat();
    }

?>
