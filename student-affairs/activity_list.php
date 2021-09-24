<?php
    session_start();
    ob_start();

    //check session - student id, name, e-mail
    // $_SESSION['std_id'] = "6210518001";
    // $_SESSION['std_name'] = "กนกกาญจน์ หนูนวล";
    // $_SESSION['std_email'] = "6210518001@email.psu.ac.th";
    // $_SESSION['profile_img'] = "../assets/images/users/default_student_b.jpg";
    // $_SESSION['academic_year'] = "2563";

    if (!isset($_SESSION['std_id'])) {
        header("Location: ../login.php");
        exit;
    }

    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity.php';
    include_once '../php/tb_activity_type.php';
    include_once '../php/tb_activity_register.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $activity = new Activity($db);
    $stype = new Activity_type($db);
    $act_register = new Activity_regitser($db);

    //read all active records
    $active_stype = true;
    $result_stype = $stype->act_readall($active_stype);
    $result_stype_add = $stype->act_readall($active_stype);

    //read all active activitys info
    //$active = true;
    $activity->academic_year = $_SESSION['academic_year'];
    $result = $activity->act_readforacyear();

    ob_end_flush();

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="FMS Student Portal">
    <meta name="author" content="Ruchdee, Pop, Bank, Man, Dome">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172941612-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-172941612-1');
    </script>
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
	<title>ข้อมูลกิจกรรม | FMS Student Portal</title>
	<!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css">
    <link href="../assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {font-family: 'Sarabun', sans-serif;}
    </style>
    <link href="../dist/css/logo-text-student.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header border-right">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="../main.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logos/logo-4.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logos/logo-4.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text logo-text-rotate ml-2">
                            <p class="text-rotate">
                                <span class="word wisteria">FMSquare</span>
                                <span class="word belize">@FMS&middot;PSU</span>
                                <span class="word pomegranate">Student</span>
                                <span class="word green">Portal</span>
                            </p>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-18"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-18 mdi mdi-message-text-outline"></i>
                                <div class="notify">
                                <!-- notify red dot-->
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                    <!-- count unread message -->
                                        <div class="drop-title border-bottom" id="count_unread_message"></div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body" id="message_last4">
                                        </div>
                                    </li>
                                    <!-- Sending message feature is temporary close. Ruchdee 11/12/2020 -->
                                    <!-- <li>
                                        <a class="nav-link text-center link text-dark" href="../academic/message_list.php"> <b>ดูข้อความทั้งหมด</b> <i class="fa fa-angle-right"></i> </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"><a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-md-block"><i class="mdi mdi-dialpad font-18"></i></span>
                             <span class="d-block d-md-none"><i class="mdi mdi-dialpad font-18"></i></span>
                            </a>
                            <div class="dropdown-menu animated bounceInDown">
                                <div class="mega-dropdown-menu row">
                                    <div class="col-lg-3 mb-4">
                                        <h5 class="mb-3">ติดต่อเรา</h5>
                                        <!-- Accordian -->
                                        <div id="accordion" class="accordion">
                                            <div class="card mb-1">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  งานจัดการศึกษา
                                                </button>
                                              </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <h5 class="font-medium mb-0"><a href="https://www.facebook.com/fmsedu" target="_blank"><i class="mdi mdi-facebook-box text-info font-18"></i> @fmsedu</a></h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-deskphone font-18 text-info"></i> 0-7428-7823</h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-deskphone font-18 text-info"></i> 0-7428-7825-26</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  งานพัฒนานักศึกษาและส่งเสริมการทำงาน
                                                </button>
                                              </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <h5 class="font-medium mb-0"><a href="https://www.facebook.com/stu.fms.psu" target="_blank"><i class="mdi mdi-facebook-box text-info font-18"></i> @stu.fms.psu</a></h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-deskphone font-18 text-info"></i> 0-7428-7828-29</h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-deskphone font-18 text-info"></i> 0-7428-7950</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <div class="card-header" id="headingThree">
                                                    <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                  คณะวิทยาการจัดการ
                                                </button>
                                              </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-map-marker font-18 text-warning"></i> 15 ถ.กาญจนวณิชย์ อ.หาดใหญ่ จ.สงขลา 90112</h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-deskphone font-18 text-info"></i> 0-7428-7900</h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-fax font-18 text-info"></i> 0-7428-7890</h5>
                                                        <h5 class="font-medium mb-0"><i class="mdi mdi-email font-18 text-info"></i> fms-info@group.psu.ac.th</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xlg-4 mb-4">
                                        <h5 class="mb-3">ติดตามเรา</h5>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="https://www.fms.psu.ac.th" target="_blank"><i class="mdi mdi-web text-primary font-20"></i> คณะวิทยาการจัดการ</a></li>
                                            <li><a href="https://www.facebook.com/fmspsu/" target="_blank"><i class="mdi mdi-facebook-box text-info font-20"></i> @fmspsu</a></li>
                                            <li><a href="https://www.youtube.com/channel/UCJgr5jHOOx9HCf6nG4lZbAg/"  target="_blank"><i class="mdi mdi-youtube-play text-danger font-20"></i> FMSPSU Channel</a></li>
                                            <li><a href="https://www.linkedin.com/company/faculty-of-management-sciences-prince-of-songkla-university-thailand/" target="_blank"><i class="mdi mdi-linkedin-box text-info font-20"></i> Faculty of Management Sciences</a></li>
                                            <li><a href="https://line.me/R/ti/p/@fmspsu" target="_blank"><i class="fab fa-line text-success font-20"></i> @fmspsu</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <h5 class="mb-3">แผนที่</h5>
                                        <!-- Contact -->
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3959.9803893782337!2d100.498233!3d7.011589!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe7ed0a5be10edd2b!2z4LiE4LiT4Liw4Lin4Li04LiX4Lii4Liy4LiB4Liy4Lij4LiI4Lix4LiU4LiB4Liy4LijIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4ouC4quC4h-C4guC4peC4suC4meC4hOC4o-C4tOC4meC4l-C4o-C5jA!5e0!3m2!1sth!2sth!4v1593961705051!5m2!1sth!2sth" width="550" height="300" frameborder="0" style="border:0;" allowfullscreen="true" aria-hidden="false" tabindex="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item search-box"> 
                            <form class="app-search d-none d-lg-block">
                                <input type="text" class="form-control" placeholder="Search...">
                                <a href="" class="active"><i class="fa fa-search"></i></a>
                            </form>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo $_SESSION['profile_img']; ?>" alt="user" class="rounded-circle" width="36">
                                <span class="ml-2 font-medium"><?php echo $_SESSION['std_id']; ?></span><span class="fas fa-angle-down ml-2"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="<?php echo $_SESSION['profile_img']; ?>" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h5 class="mb-0"><?php echo $_SESSION['std_name']; ?></h5>
                                        <p class=" mb-0 text-muted"><?php echo $_SESSION['std_email']; ?></p>
                                        <a href="../academic/student_profile.php" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../main.php" aria-expanded="false">
                                <i class="mdi mdi-apps"></i>
                                <span class="hide-menu">เมนูหลัก</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../academic/news_list.php" class="sidebar-link waves-effect waves-dark" aria-expanded="false">
                                <i class="mdi mdi-bell-ring"></i>
                                <span class="hide-menu"> ข่าวสารและประกาศ </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../academic/calendar_list.php" class="sidebar-link waves-effect waves-dark" aria-expanded="false">
                                <i class="mdi mdi-calendar"></i>
                                <span class="hide-menu"> ปฏิทิน </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <!-- <a href="../academic/message_list.php" class="sidebar-link waves-effect waves-dark" aria-expanded="false"> -->
                            <a href="#" class="sidebar-link waves-effect waves-dark" aria-expanded="false">
                                <i class="mdi mdi-message-processing"></i>
                                <span class="hide-menu"> ข้อความ </span>
                                <span class="badge badge-warning badge-pill ml-auto mr-3 font-medium px-2 py-1">กำลังปรับปรุง</span>
                            </a>
                        </li>
                        <!-- Add new feature - June 7, 2021    Aj.Ruchdee -->
                        <li class="sidebar-item">
                            <a href="../academic/course_link_list.php" class="sidebar-link waves-effect waves-dark" aria-expanded="false">
                                <i class="mdi mdi-link-variant"></i>
                                <span class="hide-menu"> ลิงค์รายวิชา </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-school"></i>
                                <span class="hide-menu">บริการการศึกษา</span> 
                                <!-- <span class="badge badge-info badge-pill ml-auto mr-3 font-medium px-2 py-1">10</span> -->
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="../academic/student_profile.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลนักศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../academic/lecturer_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลอาจารย์ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../academic/aca_activity_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลกิจกรรมวิชาการ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../academic/online_learning.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> การเรียนการสอนออนไลน์ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="https://sis.psu.ac.th" target="_blank" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ผลการลงทะเบียน </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="https://sis.psu.ac.th" target="_blank" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ผลการเรียน </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="https://sis.psu.ac.th" target="_blank" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ผลการสอบภาษาอังกฤษ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="https://cvs.fms.psu.ac.th" target="_blank" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ทวนสอบรายวิชา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="https://tes.psu.ac.th/login.asp" target="_blank" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ประเมินรายวิชา </span>
                                    </a>
                                </li>
                                <!-- <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> อาจารย์ที่ปรึกษาออนไลน์</span>
                                    </a>
                                </li> -->
                                <li class="sidebar-item">
                                    <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                        <i class="mdi mdi-clipboard-text"></i>
                                        <span class="hide-menu"> แบบฟอร์มเอกสาร </span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item">
                                            <a href="../academic/form_list.php" class="sidebar-link">
                                                <i class="mdi mdi-download-box"></i>
                                                <span class="hide-menu"> ดาวน์โหลด </span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="../academic/form_submission.php" class="sidebar-link">
                                                <i class="mdi mdi-upload"></i>
                                                <span class="hide-menu"> อัพโหลด </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../academic/aca_survey_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> สำรวจรายวิชา</span>
                                    </a>
                                </li>
                                <!-- Add new feature - June 12, 2021    Aj.Ruchdee -->
                                <li class="sidebar-item">
                                    <a href="../academic/aca_moreless_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> หน่วยกิตเกิน/น้อยกว่ากำหนด </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">พัฒนานักศึกษา</span>
                                <!-- <span class="badge badge-warning badge-pill ml-auto mr-3 font-medium px-2 py-1">5</span> -->
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="about.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> เกี่ยวกับพัฒนานักศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="welfare.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> สวัสดิการนักศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="scholarship_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ทุนการศึกษา </span>
                                        <!-- <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">update</span> -->
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="activity_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลกิจกรรม </span>
                                    </a>
                                </li>
                                <!-- <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> การเข้าร่วมกิจกรรม </span>
                                    </a>
                                </li> -->
                                <li class="sidebar-item">
                                    <a href="university_life.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ชีวิตในรั้วมหาวิทยาลัย </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <div class="devider"></div>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php" aria-expanded="false">
                                <i class="mdi mdi-logout text-info"></i>
                                <span class="hide-menu">Log Out</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
                                <i class="mdi mdi-marker-check text-success"></i>
                                <span class="hide-menu">FAQs</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
			<!-- ============================================================== -->
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb border-bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h4 class="font-medium text-uppercase mb-0">ข้อมูลกิจกรรม</h4>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="../main.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">พัฒนานักศึกษา</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
	            <!-- ============================================================== -->
	            <!-- Container fluid  -->
	            <!-- ============================================================== -->
				<div class="page-content container-fluid note-has-grid">
					<ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
                        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2" id="all-activity">
                        <i class="icon-layers mr-1"></i><span class="d-none d-md-block">ทั้งหมด</span></a> 
                        <?php 
                            while ($row_stype = mysqli_fetch_array($result_stype)) { ?>
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="<?php echo $row_stype['activity_type_id']; ?>"><i class="icon-puzzle mr-1"></i><span class="d-none d-md-block"><?php echo $row_stype['activity_type_name']; ?></a>
                                </li>
                            <?php } ?>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- End Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
	                <!-- ============================================================== -->
	                <!-- Container fluid  -->
	                <!-- ============================================================== -->
                    <div class="page-content container-fluid">
                        <div id="note-full-container" class="row note-has-grid">
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="col-md-6 single-note-item all-activity <?php echo $row['activity_type_id']; ?>">
                                <div class="card card-body">
                                    <span class="side-stick bg-warning"></span>
                                    <h5 class="note-title mb-0 text-black">
                                        <strong><?php echo $row['activity_name']; ?></strong>
                                        <?php
                                            if ($row['activity_participant'] > 0) {
                                                echo " [จำนวนผู้เข้าร่วม " . $row['activity_participant'] . " คน]";
                                            } 
                                        ?>
                                    </h5>
                                    <p class="note-date font-14 text-muted"><?php echo $activity->DateThai($row['activity_date']); ?></p>
                                    <p class="card-text" data-todosubtext-html="<?php echo ""; ?>"><?php echo substr(htmlspecialchars(trim(strip_tags($row['activity_desc']))), 0, 500); ?></p>
                                    <p class="note-date font-14 text-muted mb-0">จำนวนชั่วโมงกิจกรรม <?php echo $row['activity_hour']; ?> ชั่วโมง</p>
                                    <?php 
                                        if ($row['activity_participant'] > 0) {
                                            echo "<p class='note-date font-14 text-muted'>ลงทะเบียนแล้ว " . $act_register->cntParticipant($row['activity_id']) . " คน</p>";
                                        } else {
                                            echo "<p class='note-date font-14 text-muted'></p>";
                                        }
                                    ?>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="btn btn-success btn-rounded mr-2" data-toggle="modal" data-target="#showDescModal" data-id="<?php echo $row['activity_id']; ?>" id="btn-desc">รายละเอียด</a>
                                        <?php
                                            if ($activity->chkExpired($row['activity_date'])) {
                                                echo "<a href='#' class='btn btn-secondary btn-rounded disabled' id='btn-expired'>เสร็จสิ้นกิจกรรม</a>";
                                            } else {
                                                $act_register->activity_id = $row['activity_id'];
                                                $act_register->student_id = $_SESSION['std_id'];
                                                $result_act_register = $act_register->readone();
                                                if (!mysqli_fetch_array($result_act_register)) {
                                                    echo "<a href='#' class='btn btn-info btn-rounded' data-toggle='modal' data-target='#registerModal' data-id='" . $row['activity_id'] . "' id='btn-register'>ลงทะเบียน</a>";
                                                    //echo "<a href='#' class='btn btn-info btn-rounded' data-toggle='modal' data-target='#registerModal' id='btn-register'>ลงทะเบียน</a>";
                                                } else {
                                                    echo "<a href='#' class='btn btn-danger btn-rounded' data-id='" . $row['activity_id'] . "' id='btn-unregister'>ยกเลิกลงทะเบียน</a>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
				</div>

                <!-- Show Schorlarship Description Modal -->
                <div class="modal fade" id="showDescModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">รายละเอียดกิจกรรม</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div id="modal-loader" class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <!-- content will be load here -->     
                                <div id="dynamic2-content" class="text-left"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">ลงทะเบียน - กรอกอีเมลและเบอร์โทรศัพท์</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="activity_register_op.php?action=i" method="POST" class="needs-validation" novalidate>
                                <div class="modal-body text-center">
                                    <div id="modal-loader2" class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <!-- content will be load here -->     
                                    <div id="dynamic3-content" class="text-left"></div>

                                    
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" id="btn-add" class="btn btn-info">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">ลงทะเบียน</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <form action="activity_register_op.php?action=i" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" id="activity_id" name="activity-id" required>
                                    <input type="text" id="std_id" placeholder="<?php echo $_SESSION['std_id']; ?>" readonly>
                                    <input type="hidden" id="registered_date" name="registered-date"required>
                                    <button type="submit" id="btn-add" class="btn btn-success">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="footer text-center">
                    สงวนลิขสิทธิ์ 2020 <a href="https://www.fms.psu.ac.th" target="_blank">คณะวิทยาการจัดการ</a> <a href="https://www.psu.ac.th" target="_blank">มหาวิทยาลัยสงขลานครินทร์</a>.
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
			</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<div class="chat-windows"></div>
	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- apps -->
	<script src="../dist/js/app.min.js"></script>
	<script src="../dist/js/app.init.js"></script>
	<script src="../dist/js/app-style-switcher.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="../assets/extra-libs/sparkline/sparkline.js"></script>
	<!--Wave Effects -->
	<script src="../dist/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="../dist/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="../dist/js/custom.min.js"></script>
	<!--This page JavaScript -->
    <script src="../dist/js/pages/notes/notes.js"></script>
    <script src="../assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <!--Notify-->
    <script src="../dist/js/pages/chat/notify.js" url="../academic/message_list_op.php"></script>
    <script src="../dist/js/logo-text.js"></script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } 
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        $(document).ready(function(){	
            /* $(document).on('click', '#btn-register', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');
                Swal.fire({
                    title: 'ยืนยันการลงทะเบียน?',
                    text: "หมายเหตุ ชั่วโมงกิจกรรมจะถูกบันทึกหลังการเข้าร่วมกิจกรรมจริงเท่านั้น",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน, ลงทะเบียนเดี๋ยวนี้',
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.value) {
                        $(location).attr("href", "activity_register_op.php?action=i&activity_id=" + activity_id);
                        Swal.fire(
                            'Registered!',
                            'ลงทะเบียนเรียบร้อยแล้ว',
                            'success'
                        )
                    }
                })
            }); */
            $(document).on('click', '#btn-unregister', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');
                Swal.fire({
                    title: 'ยืนยันการยกเลิกลงทะเบียน?',
                    text: "หมายเหตุ ยกเลิกการลงทะเบียนล่วงหน้า 2 วันก่อนวันจัดกิจกรรม",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน, ยกเลิกลงทะเบียนเดี๋ยวนี้',
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.value) {
                        $(location).attr("href", "activity_register_op.php?action=d&activity_id=" + activity_id);
                        Swal.fire(
                            'Unregistered!',
                            'ยกเลิกลงทะเบียนเรียบร้อยแล้ว',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-register', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');   // it will get id of clicked row
                //console.log(stype_id);
                $('#dynamic3-content').html(''); // leave it blank before ajax call
                $('#modal-loader2').show();      // load ajax loader
                $.ajax({
                    url: 'activity_list_add.php',
                    type: 'POST',
                    data: 'activity-id='+activity_id,
                    dataType: 'html'
                })
                .done(function(data){
                    $('#dynamic3-content').html('');    
                    $('#dynamic3-content').html(data); // load response 
                    $('#modal-loader2').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic3-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader2').hide();
                });
            });
            $(document).on('click', '#btn-desc', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'activity_detail.php',
                    type: 'POST',
                    data: 'activity_id='+activity_id,
                    dataType: 'html'
                })
                .done(function(data){
                    //console.log(data);	
                    $('#dynamic2-content').html('');    
                    $('#dynamic2-content').html(data); // load response 
                    $('#modal-loader').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic2-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });
            });
        });
    </script>
</body>

</html>
<?php
    if (isset($_GET['msg'])) {
        switch ($_GET['msg']) {
            case 'success':
                echo "<script>toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', 'ข้อมูลกิจกรรม');</script>";
                break;
            case 'insert-error':
                echo "<script>toastr.error('เพิ่มข้อมูลผิดพลาด', 'ข้อมูลกิจกรรม');</script>";
                break;
            case 'update-error':
                echo "<script>toastr.error('แก้ไขข้อมูลผิดพลาด', 'ข้อมูลกิจกรรม');</script>";
                break;
            case 'delete-error': 
                echo "<script>toastr.error('ลบข้อมูลผิดพลาด', 'ข้อมูลกิจกรรม');</script>";
                break;
        }
    }
?>