<?php
    session_start();
    ob_start();

    date_default_timezone_set("Asia/Bangkok");
    $date = date("Y-m-d");

    //check session - staff id, name, e-mail, profile image
    /* $_SESSION['staff_id'] = "warin.r";
    $_SESSION['staff_name'] = "วารินทร์ รามฤทธิ์";
    $_SESSION['staff_email'] = "warin.r@psu.ac.th";
    $_SESSION['staff_img'] = "../assets/images/users/girl.jpg";
    $_SESSION['academic_year'] = "2563";
    $_SESSION['semester'] = "1"; */

    if (!isset($_SESSION['staff_id'])) {
        header("Location: login.php");
        exit;
    }

    include_once '../php/dbconnect.php';
    include_once '../php/tb_calendar.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $calendar = new Calendar($db);

    //'S' - Student Affairs
    $calendar->calendar_owner = "S";
    $events = $calendar->readallforunit();
    
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
    <meta name="author" content="Ruchdee. Pop, Bank, Man, Dome">
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
    <title>ปฏิทินกิจกรรม-เจ้าหน้าที่ | FMS Student Portal</title>
    <!-- Custom CSS -->
    <link href="../assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="../assets/extra-libs/calendar/act-calendar.css" rel="stylesheet" />
    <link href="../assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {font-family: 'Sarabun', sans-serif;}
    </style>
    <link href="../dist/css/logo-text-staff.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="act_main.php">
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
                                <span class="word white">FMSquare</span>
                                <span class="word white">@FMS&middot;PSU</span>
                                <span class="word white">Student</span>
                                <span class="word white">Portal</span>
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
                                        <a class="nav-link text-center link text-dark" href="act_message_list.php"> <b>ดูข้อความทั้งหมด</b> <i class="fa fa-angle-right"></i> </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
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
                                                  งานบริการการศึกษา
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
                                                  งานกิจการนักศึกษา
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
                                <img src="<?php echo $_SESSION['staff_img']; ?>" alt="user" class="rounded-circle" width="36">
                                <span class="ml-2 font-medium"><?php echo $_SESSION['staff_id']; ?></span><span class="fas fa-angle-down ml-2"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="<?php echo $_SESSION['staff_img']; ?>" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h5 class="mb-0"><?php echo $_SESSION['staff_name']; ?></h5>
                                        <p class=" mb-0 text-muted"><?php echo $_SESSION['staff_email']; ?></p>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
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
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="act_main.php" aria-expanded="false">
                                <i class="mdi mdi-apps"></i>
                                <span class="hide-menu">เมนูหลัก</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">กิจการนักศึกษา</span>
                                <span class="badge badge-info badge-pill ml-auto mr-3 font-medium px-2 py-1">6</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="act_news.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข่าวสารและประกาศ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link has-arrow" aria-expanded="false">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ทุนการศึกษา </span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item">
                                            <a href="scholarship_type.php" class="sidebar-link">
                                                <i class="mdi mdi-download-box"></i>
                                                <span class="hide-menu"> ประเภททุนการศึกษา </span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="scholarship.php" class="sidebar-link">
                                                <i class="mdi mdi-upload"></i>
                                                <span class="hide-menu"> ข้อมูลทุนการศึกษา </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="act_calendar.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ปฏิทินกิจกรรม </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <!-- <a href="act_message_list.php" class="sidebar-link"> -->
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อความ </span>
                                        <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">กำลังปรับปรุง</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link has-arrow" aria-expanded="false">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลกิจกรรม </span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item">
                                            <a href="activity_type.php" class="sidebar-link">
                                                <i class="mdi mdi-download-box"></i>
                                                <span class="hide-menu"> ประเภทกิจกรรม </span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="activity.php" class="sidebar-link">
                                                <i class="mdi mdi-upload"></i>
                                                <span class="hide-menu"> ข้อมูลกิจกรรมนักศึกษา </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ชีวิตในรั้วมหาวิทยาลัย </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <div class="devider"></div>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php" aria-expanded="false">
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
                    <div class="col-lg-6 col-md-6 col-xs-12 align-self-center">
                        <h4 class="font-medium text-uppercase mb-0">ปฏิทินกิจกรรม</h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="act_main.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">กิจการนักศึกษา</li>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="card card-body">
                    <div class="row">
                        <!-- <div class="col-md-4">
                            <form>
                                <input type="text" class="form-control product-search" id="input-search" placeholder="ค้นหา...">
                            </form>
                        </div> -->
                        <!-- <div class="col-md-8 text-right d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                            <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-warning text-white"><i class="mdi mdi-view-list font-16 mr-1"></i>กิจกรรมทั้งหมด</a>
                        </div> -->
                        <div class="col-md-12 justify-content-center text-center">
                            <h5 class="font-medium mb-0"><i class="mdi mdi-calendar font-18 text-info"></i> เพิ่มข้อมูลกิจกรรมโดยการคลิกวันที่หรือช่วงวันที่ในปฏิทิน</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body calender-sidebar">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN MODAL -->
                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="act_calendar_op.php?action=i">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="myModalLabel">เพิ่มปฏิทินกิจกรรม</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="compose-box">
                                        <div class="compose-content" id="addTaskModalTitle">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" id="calendar-title" name="calendar-title" class="form-control" placeholder="หัวข้อปฏิทิน" maxlength="50" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="calendar-desc" name="calendar-desc" row="3" placeholder="รายละเอียดปฏิทิน" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">วันที่เริ่มกิจกรรม</label>
                                                    <input type="date" id="start-date" name="start-date" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">เวลา</label>
                                                    <input type="time" id="start-time" name="start-time" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">วันที่สิ้นสุดกิจกรรม</label>
                                                    <input type="date" id="end-date" name="end-date" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">เวลา</label>
                                                    <input type="time" id="end-time" name="end-time" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-info">เพิ่มข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="act_calendar_op.php?action=u">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title" id="ModalEditLabel">แก้ไขปฏิทินกิจกรรม</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="compose-box">
                                        <div class="compose-content" id="addTaskModalTitle">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" id="calendar-title-edit" name="calendar-title-edit" class="form-control" placeholder="หัวข้อปฏิทิน" maxlength="50" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="calendar-desc-edit" name="calendar-desc-edit" row="3" placeholder="รายละเอียดปฏิทิน" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">วันที่เริ่มกิจกรรม</label>
                                                    <input type="date" id="start-date-edit" name="start-date-edit" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">เวลา</label>
                                                    <input type="time" id="start-time-edit" name="start-time-edit" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">วันที่สิ้นสุดกิจกรรม</label>
                                                    <input type="date" id="end-date-edit" name="end-date-edit" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="start" class="control-label">เวลา</label>
                                                    <input type="time" id="end-time-edit" name="end-time-edit" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="calendar-id" name="calendar-id" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                                    <button type="button" class="btn btn-primary" id="btn-delete" name="btn-delete">ลบข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
			    </div>
                <!-- END MODAL -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
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
	<script src="../assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
	<script src="../assets/extra-libs/taskboard/js/jquery-ui.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/app-staff.init.js"></script>
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
    <script src="../assets/libs/moment/min/moment.min.js"></script>
    <script src="../assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="../assets/libs/fullcalendar/dist/locale/th.js"></script>
    <script src="../assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="../dist/js/logo-text.js"></script>
    <!--Notify -->
    <script src="../dist/js/pages/chat/notify.js" url="act_message_list_op.php"></script>

    <script>
		$(document).ready(function () {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                navLinks: true,
                defaultDate: '<?php echo $date ?>',
                minTime: '00:00:00',
                maxTime: '24:00:00',
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    $('#ModalAdd #start-date').val(moment(start).format('YYYY-MM-DD'));
                    $('#ModalAdd #end-date').val(moment(end).format('YYYY-MM-DD'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function (event, element) {
                    element.bind('dblclick', function () {
                        $('#ModalEdit #calendar-id').val(event.id);
                        $('#ModalEdit #calendar-title-edit').val(event.title);
                        $('#ModalEdit #calendar-desc-edit').val(event.desc);
                        $('#ModalEdit #start-date-edit').val(event.start.format('YYYY-MM-DD'));
                        $('#ModalEdit #end-date-edit').val(event.end.format('YYYY-MM-DD'));
                        $('#ModalEdit #start-time-edit').val(event.start_time);
                        $('#ModalEdit #end-time-edit').val(event.end_time);
                        $('#ModalEdit #btn-delete').attr('data-id', event.id);
                        $('#ModalEdit').modal('show');
                    });
                },
                eventDrop: function (event, delta, revertFunc) { // si changement de position
                    edit(event);
                },
                eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur
                    edit(event);
                },
                events: [
                <?php foreach($events as $event): ?>
                    {
                        id: '<?php echo $event['calendar_id']; ?>',
                        title: '<?php echo $event['calendar_title']; ?>',
                        desc: '<?php echo $event['calendar_desc'];?>',
                        start: '<?php echo $event['start_date'] . " " . $event['start_time']; ?>',
                        end: '<?php echo $event['end_date'] . " " . $event['end_time']; ?>',
                        start_time: '<?php echo $event['start_time']; ?>',
                        end_time: '<?php echo $event['end_time']; ?>',
                        color: '#FA8B73',
                        academic_year: '<?php echo $event['academic_year']; ?>',
                        semester: '<?php echo $event['semester']; ?>'
                    },
                <?php endforeach; ?>
                ]
            });

			function edit(event) {
				start = event.start.format('YYYY-MM-DD');
				if (event.end) {
					end = event.end.format('YYYY-MM-DD');
				} else {
					end = start;
				}
				id = event.id;
				Event = [];
				Event[0] = id;
				Event[1] = start;
                Event[2] = end;

                $.ajax({
					url: 'act_calendar_op.php?action=ud',
					type: 'POST',
                    data: { Event: Event },
                    dataType: 'html',
					success: function (rep) {
						if (rep == 'success') {
                            toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', 'ปฏิทินกิจกรรม');
						} else {
                            toastr.error('แก้ไขข้อมูลผิดพลาด', 'ปฏิทินกิจกรรม');
						}
					}
				});
			}
        });
        
        $(document).on('click', '#btn-delete', function(e){
            e.preventDefault();
            var calendar_id = $(this).data('id');
            Swal.fire({
                title: 'แน่ใจว่าต้องการลบข้อมูล?',
                text: "คำเตือน เมื่อข้อมูลถูกลบ จะไม่สามารถเรียกคืนได้!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน, ลบเดี๋ยวนี้',
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.value) {
                    $(location).attr("href", "act_calendar_op.php?action=d&calendar_id=" + calendar_id);
                    Swal.fire(
                        'Deleted!',
                        'ลบข้อมูลเรียบร้อยแล้ว',
                        'success'
                    )
                }
            })
        });
	</script>
</body>

</html>
<?php
    if (isset($_GET['msg'])) {
        switch ($_GET['msg']) {
            case 'success':
                echo "<script>toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', 'ปฏิทินกิจกรรม');</script>";
                break;
            case 'insert-error':
                echo "<script>toastr.error('เพิ่มข้อมูลผิดพลาด', 'ปฏิทินกิจกรรม');</script>";
                break;
            case 'update-error':
                echo "<script>toastr.error('แก้ไขข้อมูลผิดพลาด', 'ปฏิทินกิจกรรม');</script>";
                break;
            case 'delete-error': 
                echo "<script>toastr.error('ลบข้อมูลผิดพลาด', 'ปฏิทินกิจกรรม');</script>";
                break;
        }
    }
?>