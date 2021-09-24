<?php
    session_start();
    ob_start();

    //check session - staff id, name, e-mail, profile image, academic year, semester
    /* $_SESSION['staff_id'] = "tippawan.p";
    $_SESSION['staff_name'] = "ทิพวรรณ ปิ่นทองพันธ์ ";
    $_SESSION['staff_email'] = "tippawan.p@psu.ac.th";
    $_SESSION['staff_img'] = "../assets/images/users/girl.jpg";
    $_SESSION['academic_year'] = "2563";
    $_SESSION['semester'] = "1"; */

    if (!isset($_SESSION['staff_id'])) {
        header("Location: login.php");
    }
    include_once '../php/dbconnect.php';
    include_once '../php/tb_form_submission.php';
    include_once '../php/tb_aca_form.php';
    include_once '../php/tb_student_profile.php';           //June 21, 2021 Aj.Ruchdee

    //get connection
    $database = new Database();
    $db = $database->getConnection();
    $db_m = $database->getConnection_main();        //June 21, 2021 Aj.Ruchdee

    //pass connection to table
    $fsubmission = new Form_submission($db);
    $form = new Form($db);
    $student = new Studentp($db_m);                 //June 21, 2021 Aj.Ruchdee

    //read all records from form_submission table
    $fsubmission->academic_year = $_SESSION['academic_year'];
    $fsubmission->semester = $_SESSION['semester'];
    if (isset($_POST['btn-search'])) {
        if ($_POST['search-type']=="all") {
            $select_all = true;
            $fsubmission->form_id = "all";
        } else {
            $select_all = false;
            $fsubmission->form_id = $_POST['search-type'];
        }
    } else {
        $select_all = true;
        $fsubmission->form_id = "all";
    }
    $result = $fsubmission->readforacyear_semester();

    $active_form = "true";
    $result_form = $form->readall($active_form);

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
    <title>ข้อมูลอัพโหลดแบบฟอร์ม-เจ้าหน้าที่ | FMS Student Portal</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="../assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <link href="../assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="aca_main.php">
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
                                    <!-- Sending message feature is temporary close. Ruchdee 10/12/2020 -->
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
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="aca_main.php" aria-expanded="false">
                                <i class="mdi mdi-apps"></i>
                                <span class="hide-menu">เมนูหลัก</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-school"></i>
                                <span class="hide-menu">บริการการศึกษา</span> 
                                <!-- <span class="badge badge-warning badge-pill ml-auto mr-3 font-medium px-2 py-1">5</span> -->
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="aca_news.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข่าวสารและประกาศ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="aca_calendar.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ปฏิทินการศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <!-- <a href="aca_message_list.php" class="sidebar-link"> -->
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อความ </span>
                                        <span class="badge badge-light badge-pill ml-auto mr-3 font-medium px-2 py-1">กำลังปรับปรุง</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link has-arrow" aria-expanded="false">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลกิจกรรม </span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item">
                                            <a href="aca_activity_type.php" class="sidebar-link">
                                                <i class="mdi mdi-download-box"></i>
                                                <span class="hide-menu"> ประเภทกิจกรรม </span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="aca_activity.php" class="sidebar-link">
                                                <i class="mdi mdi-upload"></i>
                                                <span class="hide-menu"> ข้อมูลกิจกรรมวิชาการ </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                        <i class="mdi mdi-clipboard-text"></i>
                                        <span class="hide-menu"> แบบฟอร์มเอกสาร </span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <li class="sidebar-item">
                                            <a href="aca_form.php" class="sidebar-link">
                                                <i class="mdi mdi-download-box"></i>
                                                <span class="hide-menu"> จัดการแบบฟอร์ม </span>
                                            </a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="form_submit_list.php" class="sidebar-link">
                                                <i class="mdi mdi-upload"></i>
                                                <span class="hide-menu"> ข้อมูลอัพโหลดแบบฟอร์ม </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="aca_course_survey.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> สำรวจรายวิชา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="aca_register_moreless.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> หน่วยกิตเกิน/น้อยกว่ากำหนด </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="aca_course_link.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ลิงค์รายวิชา </span>
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
                        <h4 class="font-medium text-uppercase mb-0">ข้อมูลอัพโหลดแบบฟอร์ม</h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="aca_main.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">บริการการศึกษา</li>
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
                    <div class="col-12">
                        <div class="material-card card">
                            <div class="card-body">
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                    <div class="input-group mr-sm-2 col-md-7">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-search text-success"></i>
                                            </div>
                                        </div>
                                        <select class="form-control custom-select mr-sm-2" id="search-type" name="search-type">
                                            <option value="all" <?php if($select_all) echo "selected"; ?>>ทุกประเภท</option>
                                            <?php
                                                while ($row_form = mysqli_fetch_array($result_form)) {
                                                    if (!$select_all && $row_form['form_id']==$_POST['search-type']) {
                                                        echo "<option value='" . $row_form['form_id'] . "' selected>" . $row_form['form_name'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row_form['form_id'] . "'>" . $row_form['form_name'] . "</option>";
                                                    }
                                                } 
                                            ?>
                                        </select>
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-info" id="btn-search" name="btn-search"> แสดงข้อมูล</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="material-card card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="alt_pagination" class="table table-striped display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>fsubmission_id</th>
                                                <th>วันที่อัพโหลด</th>
                                                <th>รหัสนักศึกษา</th>
                                                <th>สาขาวิชา</th>
                                                <th>ประเภทแบบฟอร์ม</th>
                                                <th class="text-center">หมายเหตุ</th>
                                                <th class="text-center">ดาวน์โหลด</th>
                                                <th class="text-center">ส่งต่อ</th>
                                                <th class="text-center">สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                                            <?php
                                                $form->form_id = $row['form_id'];
                                                $result_fname = $form->readone();
                                                $row_fname = mysqli_fetch_array($result_fname); 
                                                //find student profile, June 21, 2021 Aj.Ruchdee
                                                $student->student_id = $row['student_id'];
                                                $result_std = $student->readone();
                                                $row_std = mysqli_fetch_array($result_std);
                                            ?>
                                            <tr>
                                                <td><?php echo $row['fsubmission_id']; ?></td>
                                                <td><?php echo $fsubmission->DateThai($row['fsubmission_date']); ?></td>
                                                <td><?php echo $row['student_id']; ?></td>
                                                <td><?php echo $row_std['dept_name_th']; ?></td>
                                                <td><?php echo $row_fname['form_name']; ?></td>
                                                <td><?php echo $row['fsubmission_remark']; ?></td>
                                                <td class="text-center"><a href="<?php echo $row['fsubmission_filename']; ?>" class="text-success" target="_blank"><i class="fa fa-download"></i></a></td>
                                                <td class="text-center"><a href="#" class="text-primary" data-toggle="modal" data-target="#forwardModal" data-id="<?php echo $row['fsubmission_id']; ?>" id="btn-forward"><i class="fa fa-share-square"></i></a></td>
                                                <td>
                                                <?php
                                                    switch ($row['fsubmission_status']) {
                                                        case '1':
                                                            echo "รับเอกสารแล้ว";
                                                            break;
                                                        case '2':
                                                            echo "กำลังดำเนินการ";
                                                            break;
                                                        case '3':
                                                            echo "ติดต่อเจ้าหน้าที่";
                                                            break;
                                                        case '4':
                                                            echo "อนุมัติ";
                                                            break;
                                                        case '5':
                                                            echo "ไม่อนุมัติ";
                                                            break; 
                                                    }
                                                ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="text-warning" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['fsubmission_id']; ?>" id="btn-update"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="#" class="text-danger ml-1" data-id="<?php echo $row['fsubmission_id']; ?>" id="btn-delete"><i class="mdi mdi-delete font-18"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>fsubmission_id</th>
                                                <th>วันที่อัพโหลด</th>
                                                <th>รหัสนักศึกษา</th>
                                                <th>สาขาวิชา</th>
                                                <th>ประเภทแบบฟอร์ม</th>
                                                <th class="text-center">หมายเหตุ</th>
                                                <th class="text-center">ดาวน์โหลด</th>
                                                <th class="text-center">ส่งต่อ</th>
                                                <th class="text-center">สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update Modal -->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">แก้ไขสถานะ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form-update" method="post" action="form_submit_op.php?action=u">
                            <div class="modal-body text-center">
                                <div id="modal-loader" class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <!-- content will be load here -->     
                                <div id="dynamic2-content" class="text-left"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" id="btn-edit" class="btn btn-info">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Forward Modal -->
            <div class="modal fade" id="forwardModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">ส่งต่อข้อมูลอัพโหลดแบบฟอร์ม</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form-forward" method="post" action="form_submit_op.php?action=f">
                            <div class="modal-body text-center">
                                <div id="modal-loader3" class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <!-- content will be load here -->     
                                <div id="dynamic3-content" class="text-left"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" id="btn-edit" class="btn btn-info">ส่งข้อมูล</button>
                            </div>
                        </form>
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
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="../assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="../assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../dist/js/logo-text.js"></script>
    <!--Notify -->
    <script src="../dist/js/pages/chat/notify.js" url="aca_message_list_op.php"></script>

    <script>
        $(document).ready(function(){
            table = $('#alt_pagination').DataTable({
                destroy: true,
                "order": [[0, "desc"]],
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false
                    }
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function(){	
            $(document).on('click', '#btn-update', function(e){
                e.preventDefault();
                var fsubmission_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'form_submit_update.php',
                    type: 'POST',
                    data: 'fsubmission_id='+fsubmission_id,
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

            $(document).on('click', '#btn-forward', function(e){
                e.preventDefault();
                var fsubmission_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic3-content').html(''); // leave it blank before ajax call
                $('#modal-loader3').show();      // load ajax loader
                $.ajax({
                    url: 'form_submit_forward.php',
                    type: 'POST',
                    data: 'fsubmission_id='+fsubmission_id,
                    dataType: 'html'
                })
                .done(function(data){
                    //console.log(data);	
                    $('#dynamic3-content').html('');    
                    $('#dynamic3-content').html(data); // load response 
                    $('#modal-loader3').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic2-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader3').hide();
                });
            });

            $(document).on('click', '#btn-delete', function(e){
                e.preventDefault();
                var fs_id = $(this).data('id');
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
                        $(location).attr("href", "form_submit_op.php?action=d&fsubmission_id=" + fs_id);
                        Swal.fire(
                            'Deleted!',
                            'ลบข้อมูลเรียบร้อยแล้ว',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
</body>

</html>
<?php
    if (isset($_GET['msg'])) {
        switch ($_GET['msg']) {
            case 'success':
                echo "<script>toastr.success('บันทึกข้อมูลเรียบร้อยแล้ว', 'ข้อมูลอัพโหลดแบบฟอร์ม');</script>";
                break;
            case 'update-error':
                echo "<script>toastr.error('แก้ไขข้อมูลผิดพลาด', 'ข้อมูลอัพโหลดแบบฟอร์ม');</script>";
                break;
            case 'email-error': 
                echo "<script>toastr.error('ไม่สามารถส่งอีเมล', 'ข้อมูลอัพโหลดแบบฟอร์ม');</script>";
                break;
            case 'delete-error': 
                echo "<script>toastr.error('ลบข้อมูลผิดพลาด', 'ข้อมูลอัพโหลดแบบฟอร์ม');</script>";
                break;
        }
    }
?>