<?php
    session_start();

    //check session - student id, name, e-mail
    // $_SESSION['std_id'] = "6210518001";
    // $_SESSION['std_name'] = "กนกกาญจน์ หนูนวล";
    // $_SESSION['std_email'] = "6210518001@email.psu.ac.th";
    // $_SESSION['profile_img'] = "../assets/images/users/default_student_b.jpg";

    if (!isset($_SESSION['std_id'])) {
        header("Location: ../login.php");
        exit;
    }

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
	<title>สวัสดิการนักศึกษา | FMS Student Portal</title>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css">
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
                        <h4 class="font-medium text-uppercase mb-0">สวัสดิการนักศึกษา </h4>
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
				<div class="page-content container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#scholarship" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">ทุนการศึกษา</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#popular" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">เงินสนับสนุนสำหรับนักศึกษาที่สร้างชื่อเสียงให้กับคณะวิทยาการจัดการ </span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#TOEIC" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">เงินสนับสนุนค่าสมัครสอบ TOEIC </span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#passport" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">บริการจัดทำหนังสือเดินทาง </span></a> </li> <br><br>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#EnglishCamp" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">เงินสนับสนุนการเข้าร่วมโครงการ English Camp</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sult" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">บริการเสื้อสูท</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#moneysos" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">เงินยืมฉุกเฉินเพื่อการศึกษา</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#job" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">การรับสมัครงาน</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#visit" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">การเยี่ยมไข้นักศึกษา</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#service" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down">บริการของหายได้คืน</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#post" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt"></i></span> <span class="hidden-xs-down"> ไปรษณียภัณฑ์</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border p-4">
                                        <div class="tab-pane active" id="scholarship" role="tabpanel">
                                            <div class="">
                                           <center><img src="../assets/images/scholarship2.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>ทุนการศึกษา</h4></u></p>
                                                <p>คณะฯ เปิดรับสมัครนักศึกษาชั้นปีที่ 1-4 ขอรับทุนการศึกษาเป็นประจำทุกภาคการศึกษา โดยเปิดรับสมัครในช่วง 2 สัปดาห์แรกของการเปิดภาคการศึกษาปกติ โดยมีทั้งทุนขาดแคลนทุนทรัพย์และทุนทำงานแลกเปลี่ยน</p>
                                                <p> <strong> สิ่งที่ควรรู้</strong></p>
                                                <p>1. ทุนการศึกษาคณะวิทยาการจัดการสามารถสมัครได้ที่งานกิจการนักศึกษา คณะวิทยาการจัดการ อาคารบริหาร ชั้น 1</p>
                                                <p>2. ทุนของมหาวิทยาลัยฯ และเงินกู้กยศ./กรอ. สามารถสมัครได้ที่กองกิจการนักศึกษา สำนักงานอธิการบดี ชั้น 2</p>
                                                <p>3. นักศึกษาสามารถสมัครทุนการศึกษาในข้อ 1 และข้อ 2 พร้อมกันได้</p>
                                                <p>4. นักศึกษาชั้นปีที่ 1 จะสามารถสมัครทุนทำงานแลกเปลี่ยนได้ในภาคการศึกษาที่ 2 สำหรับนักศึกษาชั้นปีที่ 2-4 สามารถสมัครทุนทำงานแลกเปลี่ยนได้ทุกภาคการศึกษาปกติ คลิก  <a href="https://www.facebook.com/stu.fms.psu">https://www.facebook.com/stu.fms.psu</a></p>
                                                <h5>1.1 ทุนทำงานแลกเปลี่ยน</h5>
                                                Link ใบสมัคร: <a href=" https://forms.gle/KZpVGSe4qH5o2owz7">https://forms.gle/KZpVGSe4qH5o2owz7</a><br><br>
                                                <h5>1.2 ทุนขาดแคลนทุนทรัพย์</h5>
                                                Link ใบสมัคร : <a href=": https://drive.google.com/file/d/1PQ1lQJJ_l7ZryaRA4cCju6Zlwsnkjpd-/view?usp=sharing">: https://drive.google.com/file/d/1PQ1lQJJ_l7ZryaRA4cCju6Zlwsnkjpd-/view?usp=sharing</a><br><br>
                                                <h5>1.3 กยศ./กรอ.</h5>
                                                Link: <a href="https://www.facebook.com/psustl.hatyai/">https://www.facebook.com/psustl.hatyai/</a><br><br>
                                                <h5>1.4 ทุนการศึกษา  มหาวิทยาลัยฯ</h5>
                                                <a href="https://www.facebook.com/PSU.scholarship/ ">https://www.facebook.com/PSU.scholarship/</a><br><br>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="popular" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/poppular.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><h4><u>เงินสนับสนุนสำหรับนักศึกษาที่สร้างชื่อเสียงให้กับคณะวิทยาการจัดการ</u></h4></p>
                                                <p>เงินสนับสนุนจะมอบให้กับนักศึกษาที่เข้าร่วมการแข่งขันทางด้านวิชาการ หากได้รับรางวัลชนะเลิศระดับชาติหรือระดับนานาชาติ  สนับสนุนเงินให้รายละ 5,000 บาท (ห้าพันบาทถ้วน) ทั้งนี้ไม่เกินทีมละ 40,000 บาท (สี่หมื่นบาทถ้วน) หากนักศึกษาเข้ารอบชิงชนะเลิศแต่ไม่ได้รับรางวัลชนะเลิศจะมอบให้รายละ 3,000 บาท (สามพันบาทถ้วน)</p>
                                                link : <a href="https://drive.google.com/file/d/1N8eUDWmV-FAmrbDYUB903IcbXS5Za7TE/view?usp=sharing">https://drive.google.com/file/d/1N8eUDWmV-FAmrbDYUB903IcbXS5Za7TE/view?usp=sharing</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="TOEIC" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/toeic.png" alt="img1" width="auto" height="100%"></center>
                                                <p><u><h4>เงินสนับสนุนค่าสมัครสอบ TOEIC</h4></u></p>
                                                <p>คณะฯ สนับสนุนค่าสมัครสอบ TOEIC เพื่อให้นักศึกษาชั้นปีที่ 3-4 ได้พัฒนาภาษาอังกฤษสำหรับเตรียมความพร้อมในการสมัครงาน และสร้างขวัญกำลังใจให้กับนักศึกษา โดยสนับสนุนให้กับนักศึกษาที่สอบ TOEIC กับกองกิจการนักศึกษา มหาวิทยาลัยสงขลานครินทร์  และได้คะแนนสอบ 600 คะแนนขึ้นไป สามารถยื่นแบบฟอร์มขอรับเงินสนับสนุนได้ภายใน 15 วัน หลังจากประกาศผลคะแนนสอบ</p>
                                                Link: <a href="https://drive.google.com/file/d/1GqFxQVFUdHOtqsyDqBJFRLBfDQEEmO2D/view?usp=sharing">https://drive.google.com/file/d/1GqFxQVFUdHOtqsyDqBJFRLBfDQEEmO2D/view?usp=sharing</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="passport" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/passport.jpg" alt="img1" width="50%" height="auto"></center>
                                            <p><u><h4>บริการจัดทำหนังสือเดินทาง</h4></u></p>
                                                <p>คณะฯ จัดให้มีบริการนำนักศึกษาที่มีความประสงค์จะทำหนังสือเดินทางเพื่อเดินทางไปต่างประเทศ โดยเปิดรับสมัครภาคการศึกษาละ 2 ครั้ง หรือนักศึกษาสามารถรวมกลุ่มจำนวนประมาณ 10-15 คน และแจ้งความจำนงมายังงานกิจการนักศึกษา เพื่อดำเนินการอำนวยความสะดวกในการประสานงานและจัดยานพาหนะในการนำนักศึกษาเดินทางไป-กลับ สำหรับการจัดทำหนังสือเดินทาง</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="EnglishCamp" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/engcamp.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>เงินสนับสนุนการเข้าร่วมโครงการ English Camp</h4></u></p>
                                                <p>คณะฯ สนับสนุนค่าลงทะเบียนให้กับนักศึกษาที่เข้าร่วมโครงการค่ายภาษาอังกฤษ (English Camp) ของมหาวิทยาลัยฯ เป็นประจำทุกปีการศึกษา โดยสนับสนุนเป็นเงินค่าสมัครเข้าร่วมโครงการรายละ 1,000 บาท (หนึ่งพันบาทถ้วน) ทั้งนี้ เพื่อส่งเสริมทักษะด้านภาษาอังกฤษ และสร้างขวัญกำลังใจให้แก่นักศึกษาที่เข้าร่วมโครงการ</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="sult" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/sult.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>บริการเสื้อสูท</h4></u></p>
                                                <p>คณะฯ ได้จัดให้มีบริการยืมเสื้อสูทแก่อาจารย์ บุคลากรและนักศึกษา เพื่อใช้ในการเรียนการสอน ประชุม อบรม และกิจกรรมต่าง ๆ รวมทั้งสิ้นจำนวน  59  ตัว โดยไม่มีค่าบริการ</p>
                                                        <p><strong>ขอรับบริการได้ที่ : </strong> งานกิจการนักศึกษา คณะวิทยาการจัดการ</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="moneysos" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/moneysos.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>เงินยืมฉุกเฉินเพื่อการศึกษา</h4></u></p>
                                              <p>คณะฯ มีบริการให้นักศึกษาคณะวิทยาการจัดการ ยืมเงินฉุกเฉินเพื่อการศึกษา คนละไม่เกิน 2,000 บาท</p>
                                              <strong>ประกาศ :</strong><a href="http://shorturl.at/qrMNR">shorturl.at/qrMNR</a><br><br>
                                              <strong>แบบฟอร์ม :</strong><a href="http://shorturl.at/BQX46">shorturl.at/BQX46</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="job" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/job.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>การรับสมัครงาน</h4></u></p>
                                                <p>คณะฯจัดให้มีกิจกรรมการสมัครงานกับหน่วยงานต่าง ๆ เป็นประจำทุกปีการศึกษา (FMS JOB FAIR) ให้กับนักศึกษาชั้นปีที่ 4 รวมถึงประสานงานกับหน่วยงานต่าง ๆ ทั้งภายในและภายนอกคณะในการรับนักศึกษาของคณะเข้าทำงาน</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="visit" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/visit.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>การเยี่ยมไข้นักศึกษา</h4></u></p>
                                            กรณีนักศึกษาเข้ารับการรักษาตัวในโรงพยาบาล คณะฯจัดให้มีกระเข้าเยี่ยมไข้รายละ 700 บาท กรณีบิดา-มารดา นักศึกษาเสียชีวิตจัดให้มีการมอบเงินทำบุญรายละ 1,000 บาท(หนึ่งพันบาทถ้วน) พร้อมพวงหรีดไว้อาลัย จำนวน  1 ชุด <br>
                                            (<strong>เอกสารแนบ :</strong>แบบฟอร์มขอรับสวัสดิการนักศึกษา คณะวิทยาการจัดการ)
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="service" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/service.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>บริการของหายได้คืน</h4></u></p>
                                            <p>	บริการรับฝากสิ่งของสำหรับนักศึกษาที่พบเจอของผู้อื่นและต้องการส่งคืนให้เจ้าของ</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="post" role="tabpanel">
                                            <div class="">
                                            <center><img src="../assets/images/post.jpg" alt="img1" width="auto" height="100%"></center>
                                            <p><u><h4>ไปรษณียภัณฑ์</h4></u></p>
                                                <p>ประสานงานนักศึกษาในการรับไปรษณียภัณฑ์ เช่น เอกสารลงทะเบียน EMS พัสดุ ฯลฯ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
				</div>
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
    <!--Notify-->
    <script src="../dist/js/pages/chat/notify.js" url="../academic/message_list_op.php"></script>
    <script src="../dist/js/logo-text.js"></script>
</body>

</html>