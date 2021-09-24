<?php
    session_start();
    ob_start();

    if (!isset($_SESSION['lecturer_ppid'])) {
        header("Location: login.php");
        exit;
    }

    //check session - lecturer id, ppid, name, e-mail, profile image
    //for test
    /* $_SESSION['lecturer_id'] = "0024121";
    $_SESSION['lecturer_ppid'] = "ruchdee.bi";
    $_SESSION['lecturer_name'] = "รุชดี บิลหมัด";
    $_SESSION['lecturer_email'] = "ruchdee.b@psu.ac.th";
    $_SESSION['lecturer_img'] = "../assets/images/users/default_lecturer.png";
    $_SESSION['academic_year'] = "2563";
    $_SESSION['semester'] = "1"; */

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
    <meta name="author" content="Ruchdee, Bank, Pop, Man, Dome">
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
    <title>FAQs-อาจารย์ | FMS Student Portal</title>
    <!-- Custom CSS -->
    <link href="../assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="../assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {font-family: 'Sarabun', sans-serif;}
    </style>
    <link href="../dist/css/logo-text-lecturer.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="main.php">
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
                                <span class="word white">Lecturer</span>
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
                                    <li>
                                        <a class="nav-link text-center link text-dark" href="message_list.php"> <b>ดูข้อความทั้งหมด</b> <i class="fa fa-angle-right"></i> </a>
                                    </li>
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
                                <img src="<?php echo $_SESSION['lecturer_img']; ?>" alt="user" class="rounded-circle" width="36">
                                <span class="ml-2 font-medium"><?php echo $_SESSION['lecturer_ppid']; ?></span><span class="fas fa-angle-down ml-2"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="<?php echo $_SESSION['lecturer_img']; ?>" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h5 class="mb-0"><?php echo $_SESSION['lecturer_name']; ?></h5>
                                        <p class=" mb-0 text-muted"><?php echo $_SESSION['lecturer_email']; ?></p>
                                        <a href="lecturer_profile.php" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
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
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="main.php" aria-expanded="false">
                                <i class="mdi mdi-apps"></i>
                                <span class="hide-menu">เมนูหลัก</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="student_list.php" class="sidebar-link">
                                <i class="mdi mdi-human-male-female"></i>
                                <span class="hide-menu"> ข้อมูลนักศึกษา </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="lecturer_profile.php" class="sidebar-link">
                                <i class="mdi mdi-owl"></i>
                                <span class="hide-menu"> ข้อมูลอาจารย์ </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="message_list.php" class="sidebar-link"><i class="mdi mdi-presentation"></i>
                                <span class="hide-menu"> ข้อความ </span>
                                <!-- <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">new</span> -->
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><i class="mdi mdi-comment-text-outline"></i>
                                <span class="hide-menu"> อาจารย์ที่ปรึกษาออนไลน์ </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="calendar_list.php" class="sidebar-link"><i class="mdi mdi-calendar-clock"></i>
                                <span class="hide-menu"> ปฏิทิน </span>
                            </a>
                        </li>
                        <div class="devider"></div>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php" aria-expanded="false">
                                <i class="mdi mdi-logout text-info"></i>
                                <span class="hide-menu">Log Out</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="faqs.php" aria-expanded="false">
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
                        <h4 class="font-medium text-uppercase mb-0">Frequency Ask Questions</h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="main.php">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lecturer Portal</li>
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
                                <!-- <h4 class="card-title">Faqs with accordion</h4> -->
                                <!-- Accordian-part -->
                                <div id="accordian-part">
                                    <div id="accordian-3" class="accordion">
                                        <div class="card mb-0">
                                            <div class="card-header bg-white pl-0">
                                                <h5 class="mb-0">
                                                    <a href="#" class="link" id="headingOne" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                        Q1. FMS Student Portal คืออะไร?
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordian-3">
                                                <div class="card-body pl-0">
                                                    FMS Student Portal หรือ FMS Portal for Student เป็นโครงการพัฒนาเว็บแอพพลิเคชั่นที่รวบรวมบริการดิจิทัลต่าง ๆ สำหรับนักศึกษาคณะวิทยาการจัดการ ทั้งด้านวิชาการ กิจกรรมพัฒนานักศึกษา และการให้คำปรึกษาออนไลน์ โดยนักศึกษาเข้าถึงข้อมูลสารสนเทศได้ทุกสถานที่และเวลาในรูปแบบ One Stop Service
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-header bg-white pl-0">
                                                <h5 class="mb-0">
                                                    <a href="#" class="collapsed link" id="headingTwo" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                        Q2. ส่วนของอาจารย์สามารถทำอะไรได้บ้าง?
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordian-3">
                                                <div class="card-body pl-0">
                                                    ในส่วนของอาจารย์สามารถเข้าถึงข้อมูลต่าง ๆ ได้ ดังต่อไปนี 1.) ข้อมูลนักศึกษา (Student Profile) 2.) ข้อมูลอาจารย์ (Lecturer Profile) 3.) ข้อความ (Message) 4.) ปฏิทิน (Calendar)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-header bg-white pl-0">
                                                <h5 class="mb-0">
                                                    <a href="#" class="collapsed link" id="headingThree" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                                        Q3. การส่งข้อความให้กับนักศึกษาทำได้กี่วิธี?
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordian-3">
                                                <div class="card-body pl-0">
                                                    การส่งข้อความให้กับนักศึกษาสามารถทำได้ 4 วิธี: 
                                                    <ol type="1">
                                                        <li>ที่เมนูข้อมูลนักศึกษา คลิกปุ่มส่งข้อความ (ปุ่มสีม่วง) จะแสดงหน้าต่างป๊อบอัพให้เลือกวิธีการส่งข้อความ สามารถเลือกส่งให้นักศึกษาคนเดียวหรือส่งเป็นกลุ่ม</li>
                                                        <li>ที่เมนูข้อมูลนักศึกษา ค้นหานักศึกษาที่ต้องการส่งข้อความในช่องค้นหา หรือดูจากลิสต์รายชื่อ หลังจากนั้นคลิกไอคอนส่งข้อความ (ไอคอนสีเขียว) จะแสดงหน้าต่างป๊อบอัพให้พิมพ์ข้อความที่ต้องการส่ง</li>
                                                        <li>ที่เมนูข้อมูลนักศึกษา ค้นหานักศึกษาที่ต้องการส่งข้อความในช่องค้นหา หรือดูจากลิสต์รายชื่อ หลังจากนั้นคลิกเครื่องหมายถูกหน้ารหัสนักศึกษาเพื่อเลือกนักศึกษาที่ต้องการส่งข้อความ (สามารถเลือกส่งข้อความได้หลายคน) คลิกปุ่มส่งข้อความ (ปุ่มสีม่วง) จะแสดงหน้าต่างป๊อบอัพให้พิมพ์ข้อความที่ต้องการส่ง</li>
                                                        <li>ที่เมนูข้อความ คลิกปุ่มค้นหารายชื่อทั้งหมด (ปุ่มสีเขียว) จะแสดงหน้าต่างป๊อบอัพให้เลือกวิธีการส่งข้อความ สามารถเลือกส่งให้นักศึกษาคนเดียวหรือส่งเป็นกลุ่ม </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-header bg-white pl-0">
                                                <h5 class="mb-0">
                                                    <a href="#"  class="collapsed link" id="headingFour" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                                        Q4. ต้องการเปลี่ยนรูปโปรไฟล์ ทำอย่างไร?
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse4" class="collapse" aria-labelledby="headingFour" data-parent="#accordian-3">
                                                <div class="card-body pl-0">
                                                    การเปลี่ยนรูปโปรไฟล์สามารถทำได้โดยไปที่เมนูข้อมูลอาจารย์ คลิก "Choose File" เพื่อเลือกรูปโปรไฟล์ที่ต้องการ แล้วคลิกปุ่มบันทึกข้อมูล
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-header bg-white pl-0">
                                                <h5 class="mb-0">
                                                    <a href="#"  class="collapsed link" id="headingFive" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                                        Q5. ปฏิทินแสดงข้อมูลอะไรบ้าง?
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse5" class="collapse" aria-labelledby="headingFive" data-parent="#accordian-3">
                                                <div class="card-body pl-0">
                                                    เมนูปฏิทินแสดงข้อมูลปฏิทินการศึกษาและข้อมูลปฏิทินกิจกรรม บันทึกข้อมูลโดยเจ้าหน้าที่งานบริการการศึกษาและงานพัฒนาศึกษา คณะวิทยาการจัดการ
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End accordian-part -->
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
    <script>
        var allevents = <?php echo $events; ?>;
        //console.log(allevents);
    </script>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/app-lecturer.init.js"></script>
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
    <script src="../dist/js/pages/calendar/cal-lecturer-init.js"></script>
    <script src="../dist/js/logo-text.js"></script>
    <!--Notify-->
    <script src="../dist/js/pages/chat/notify.js" url="lec_message_list_op.php"></script>
    
</body>

</html>