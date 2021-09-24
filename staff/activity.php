<?php
    session_start();
    ob_start();

    //check session - staff id, name, e-mail, profile image
    /* $_SESSION['staff_id'] = "warin.r";
    $_SESSION['staff_name'] = "วารินทร์ รามฤทธิ์";
    $_SESSION['staff_email'] = "warin.r@psu.ac.th";
    $_SESSION['staff_img'] = "../assets/images/users/girl.jpg";
    $_SESSION['academic_year'] = "2563"; */

    if (!isset($_SESSION['staff_id'])) {
        header("Location: login.php");
        exit;
    }

    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity_type.php';
    include_once '../php/tb_activity.php';
    include_once '../php/tb_student_profile.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_activity_register.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $stype = new Activity_type($db);
    $activity = new Activity($db);
    $activity_register = new Activity_regitser($db);
    $student = new Studentp($db_m);
    $major = new Major($db_m);

    //read all active records
    $active_stype = true;
    $result_stype = $stype->act_readall($active_stype);
    $result_stype_add = $stype->act_readall($active_stype);

    //read all records from activity table
    $active = false;
    $result = $activity->act_readall($active);

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
    <meta name="author" content="Ruchdee, Pop, Bank, Dome, Man">
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
    <title>ข้อมูลกิจกรรม-เจ้าหน้าที่ | FMS Student Portal</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css">
    <link href="../assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <!-- <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css"> -->
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
                                    <a href="university_life.php" class="sidebar-link">
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
                        <h4 class="font-medium text-uppercase mb-0">ข้อมูลกิจกรรม</h4>
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
            <div class="email-app todo-box-container">
                <!-- ============================================================== -->
	            <!-- Left Part -->
	            <!-- ============================================================== -->
                <div class="left-part list-of-tasks">
	                <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
	                <div class="scrollable" style="height:100%;">
	                    <div class="p-3">
	                        <a class="waves-effect waves-light btn btn-info d-block" href="javascript: void(0)" id="add-activity"><i class="mdi mdi-plus-box font-16 mr-1"></i>เพิ่มข้อมูล</a>
	                    </div>
	                    <div class="divider"></div>
	                    <ul class="list-group">
	                        <li>
	                            <small class="p-3 grey-text text-lighten-1 db">ประเภทกิจกรรม</small>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="javascript:void(0)" class="todo-link active list-group-item-action" id="all-news-list"><i class="mdi mdi-format-list-bulleted"></i> ทั้งหมด <span class="todo-badge badge badge-info float-right"></span></a>
                            </li>
                            <?php 
                                while ($row_stype = mysqli_fetch_array($result_stype)) { ?>
                                    <li class="list-group-item">
                                        <a href="javascript:void(0)" class="todo-link list-group-item-action" id="<?php echo $row_stype['activity_type_id']; ?>"> <i class="mdi mdi-link-variant"></i> <?php echo $row_stype['activity_type_name']; ?> <span class="todo-badge badge badge-warning float-right"></span></a>
                                    </li>
                            <?php } ?>
	                    </ul>
	                </div>
                </div>
                <!-- ============================================================== -->
                <!-- Right Part -->
                <!-- ============================================================== -->
                <div class="right-part mail-list bg-white overflow-auto">
                	<div id="todo-list-container">
                		<div class="p-3 border-bottom">
	                    	<div class="input-group searchbar">
							  	<div class="input-group-prepend">
							    	<span class="input-group-text" id="search"><i class="icon-magnifier text-muted"></i></span>
							  	</div>
							  	<input type="text" class="form-control" placeholder="ค้นหา..." aria-describedby="search">
							</div>
	                    </div>
	                    <!-- Todo list-->
	                    <div class="todo-listing">
	                    	<div id="all-todo-container" class="p-3">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <?php 
                                        if ($row['activity_type_id'] == 1) {
                                            $ntype = 'current-news';        //news type
                                        } else {
                                            $ntype = 'current-notification';        //news type
                                        }
                                        if ($row['activity_status']) {
                                            $istatus = "mdi-check-circle";
                                        } else {
                                            $istatus = "mdi-eye-off";
                                        }
                                    ?>
                                    <div class="todo-item all-news-list p-3 border-bottom position-relative <?php echo $row['activity_type_id']; ?>">
                                        <div class="inner-item d-flex align-items-start">
                                            <div class="w-100">
                                                <div class="custom-control d-flex align-items-start">
                                                    <div>
                                                        <div class="content-todo">
                                                            <h5 class="font-medium font-16 todo-header mb-0" data-todo-header="<?php echo $row['activity_name']; ?>"><?php echo $row['activity_name']; ?> <i class="mdi <?php echo $istatus; ?>"></i></h5>
                                                            <div class="todo-subtext text-muted" 
                                                                data-todosubtext-html="<?php echo substr(htmlspecialchars(trim(strip_tags($row['activity_desc']))), 0, 500); ?>" data-todosubtextText="">
                                                                <?php 
                                                                    //echo trim($row['news_desc']);
                                                                    if (strlen(trim($row['activity_desc'])) > 500) {
                                                                        echo substr(htmlspecialchars(trim(strip_tags($row['activity_desc']))), 0, 500) . "...";
                                                                    } else {
                                                                        echo trim($row['activity_desc']);
                                                                    }
                                                                ?>
                                                            </div>
                                                            <span class="todo-time font-14 text-muted"><i class="icon-calender mr-1"></i><?php echo $activity->DateThai($row['activity_date']); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <div class="dropdown-action">
                                                            <div class="dropdown todo-action-dropdown">
                                                                <button class="btn btn-link text-dark p-1 dropdown-toggle text-decoration-none todo-action-dropdown" type="button" id="more-action-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="icon-options-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="more-action-1">
                                                                    <a class="edit dropdown-item" href="#" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $row['activity_id']; ?>" id="btn-update"><i class="fas fa-edit text-info mr-1"></i> แก้ไข</a>
                                                                    <a class="remove dropdown-item" href="#" data-id="<?php echo $row['activity_id']; ?>" id="btn-delete"><i class="far fa-trash-alt text-danger mr-1"></i> ลบ</a>
                                                                    <a class="list dropdown-item" href="#" data-toggle="modal" data-target="#listModal"data-id="<?php echo $row['activity_id']; ?>" id="btn-list"><i class="far fa-list-alt text-success mr-1"></i> แสดงรายชื่อ</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Content -->											
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="text-center text-info">ไม่มีข้อมูล</div>
                            <?php } ?>
	                    	</div>
	                    	<!-- Modal -->
		                	<div class="modal fade" id="todoShowListItem" tabindex="-1" role="dialog" aria-hidden="true">
		                        <div class="modal-dialog modal-dialog-centered" role="document">
		                            <div class="modal-content border-0">
		                            	<div class="modal-header bg-light">
									        <h5 class="modal-title task-heading"></h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									    </div>
		                                <div class="modal-body">
		                                    <div class="compose-box">
		                                        <div class="compose-content">
		                                        	<label class="mb-0 font-16">รายละเอียด</label>
		                                            <p class="task-text text-muted"></p>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="modal-footer">
		                                	<button class="btn btn-secondary btn-block" data-dismiss="modal">ปิด</button>
		                                </div>
		                            </div>
		                        </div>
                            </div>
                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">แก้ไข-ข้อมูลกิจกรรม</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="form-update" method="post" action="activity_op.php?action=u">
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
                            <!-- list Modal -->
                            <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">ข้อมูลการลงทะเบียน</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div id="modalList-loader" class="spinner-border text-success" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <!-- content will be load here -->     
                                            <div id="dynamic3-content" class="text-left"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
	                    </div>
                	</div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content border-0">
                        <form id="form-add" class="form-horizontal" method="post" action="activity_op.php?action=i">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">เพิ่มข้อมูลกิจกรรม</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="compose-box">
                                    <div class="compose-content" id="addTaskModalTitle">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <select class="form-control custom-select" id="activity-type" name="activity-type" required>
                                                    <?php
                                                        while ($row_stype_add = mysqli_fetch_array($result_stype_add)) {
                                                            echo "<option value='" . $row_stype_add['activity_type_id'] ."'>" . $row_stype_add['activity_type_name'] . "</option>";
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" class="form-control" id="activity-date" name="activity-date" required><span class="validation-text"></span>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control custom-select" id="activity-status" name="activity-status" required>
                                                    <option value="" selected>สถานะ...</option>
                                                    <option value="1">แสดง</option>
                                                    <option value="0">ยกเลิก</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="d-flex mail-to mb-3">
                                                    <div class="w-100">
                                                        <input id="activity-name" name="activity-name" type="text" placeholder="ชื่อกิจกรรม" class="form-control" required maxlength="200">
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex mail-to mb-3">
                                                    <div class="w-100">
                                                        <input id="activity-hour" name="activity-hour" type="number" placeholder="จำนวนชั่วโมง" class="form-control" required maxlength="200">
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="d-flex mail-to mb-3">
                                                    <div class="w-100">
                                                        <input id="activity-participant" name="activity-participant" type="number" placeholder="จำนวนผู้เข้าร่วม" class="form-control" required maxlength="1000">
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex mail-to mb-3 mt-2">
                                                    <div class="w-100">
                                                        <span class="text-info">ใส่ <u>"0"</u> กรณีไม่ต้องการระบุจำนวน</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex mail-to mb-3 mt-2 ml-4">
                                                    <div class="w-100">
                                                        <input class="form-check-input" type="checkbox" id="activity-calendar" name="activity-calendar" value="0">
                                                        <label class="form-check-label" for="activity-calendar">แสดงในปฏิทิน</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex mail-subject mb-4">
                                            <div class="w-100">
                                                <div id="activity-desc" class=""></div>
                                                <textarea id="activity-desc-txt" name="activity-desc-txt" style="display:none"></textarea>
                                                <span class="validation-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> ยกเลิก</button>
                                <button type="submit" class="btn btn-info add-tsk"> เพิ่มข้อมูล</button>
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
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
    <script src="../assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <!-- Initialize Quill editor -->
    <!-- <script src="../dist/js/pages/todo/todo.js"></script> -->
    <script src="../dist/js/activity.js"></script>
    <script src="../dist/js/logo-text.js"></script>
    <!--Notify -->
    <script src="../dist/js/pages/chat/notify.js" url="act_message_list_op.php"></script>
    <!-- File export -->
    <script src="../dist/js/pages/datatable/jquery.dataTables.min.js"></script>
    <script src="../dist/js/pages/datatable/dataTables.buttons.min.js"></script>
    <script src="../dist/js/pages/datatable/jszip.min.js"></script>
    <script src="../dist/js/pages/datatable/pdfmake.min.js"></script>
    <script src="../dist/js/pages/datatable/vfs_fonts.js"></script>
    <script src="../dist/js/pages/datatable/buttons.html5.min.js"></script>
    <script src="../dist/js/pages/datatable/buttons.print.min.js"></script>

    <script>
        $(document).ready(function(){	
            $(document).on('click', '#btn-update', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');   // it will get id of clicked row
                //console.log(stype_id);
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'activity_update.php',
                    type: 'POST',
                    data: 'activity_id='+activity_id,
                    dataType: 'html'
                })
                .done(function(data){
                    $('#dynamic2-content').html('');    
                    $('#dynamic2-content').html(data); // load response 
                    $('#modal-loader').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic2-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });
            });
            $(document).on('click', '#btn-list', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');   // it will get id of clicked row
                $('#dynamic3-content').html(''); // leave it blank before ajax call
                $('#modalList-loader').show();      // load ajax loader
                $.ajax({
                    url: 'activity_register_list.php',
                    type: 'POST',
                    data: 'activity_id='+activity_id,
                    dataType: 'html'
                })
                .done(function(data){	
                    $('#dynamic3-content').html('');    
                    $('#dynamic3-content').html(data); // load response 
                    $('#modalList-loader').hide();		  // hide ajax loader	
                })
                .fail(function(){
                    $('#dynamic3-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modalList-loader').hide();
                });
            });
            $(document).on('click', '#btn-delete', function(e){
                e.preventDefault();
                var activity_id = $(this).data('id');
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
                        $(location).attr("href", "activity_op.php?action=d&activity_id=" + activity_id);
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