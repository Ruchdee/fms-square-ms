<?php
    session_start();
    ob_start();

    //check session - lecturer id, name, e-mail, profile image
    //for test
    /* $_SESSION['lecturer_id'] = "0024121";
    $_SESSION['lecturer_ppid'] = "ruchdee.bi";
    $_SESSION['lecturer_name'] = "รุชดี บิลหมัด";
    $_SESSION['lecturer_email'] = "ruchdee.b@psu.ac.th";
    $_SESSION['lecturer_img'] = "../assets/images/users/default_lecturer.png"; */

    if (!isset($_SESSION['lecturer_ppid'])) {
        header("Location: login.php");
        exit;
    }

    include_once '../php/dbconnect.php';
    include_once '../php/tb_student_profile.php';
    include_once '../php/tb_major.php';
    include_once '../php/tb_department.php';
    
    //get connection
    $database = new Database();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $student = new Studentp($db_m);
    $major = new Major($db_m);
    $dept = new Department($db_m);
    
    $student->adviser_id = $_SESSION['lecturer_id_card'];
    $result = $student->totalByAdvisor();
    $result_all = $student->readByAdvisor();
    //get major
    $active_major = True;
    $get_major = $major->readall($active_major);

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
    <title>ข้อมูลนักศึกษา | FMS Student Portal</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="../assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css">
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
                                    <!-- sendig message feature is close. Ruchdee 10/12/2020 -->
                                    <!-- <li>
                                        <a class="nav-link text-center link text-dark" href="message_list.php"> <b>ดูข้อความทั้งหมด</b> <i class="fa fa-angle-right"></i> </a>
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
                            <!-- <a href="message_list.php" class="sidebar-link"><i class="mdi mdi-presentation"></i> -->
                            <a href="#" class="sidebar-link"><i class="mdi mdi-presentation"></i>
                                <span class="hide-menu"> ข้อความ </span>
                                <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">กำลังปรับปรุง</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><i class="mdi mdi-comment-text-outline"></i>
                                <span class="hide-menu"> อาจารย์ที่ปรึกษาออนไลน์ </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="calendar_list.php" class="sidebar-link"><i class="mdi mdi-opacity"></i>
                                <span class="hide-menu"> ปฏิทิน </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="course_link.php" class="sidebar-link"><i class="mdi mdi-link-variant"></i>
                                <span class="hide-menu"> ลิงค์รายวิชา </span>
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
                        <h4 class="font-medium text-uppercase mb-0">ข้อมูลนักศึกษา</h4>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-lg-3 col-md-4 border-right">
                            <div class="card-body">
                                <a href="javascript:void(0)">
                                    <div class="d-flex">
                                        <span class="card-text mb-0">จำนวนนักศึกษาทั้งหมด</span>
                                        <div class="ml-auto">
                                            <span class="font-medium"><?php echo $student->totalStudent() ?></span>
                                        </div>
                                    </div>
                                </a>
                                <hr>
                                <ul class="list-style-none">
                                <?php while ($row_m = mysqli_fetch_array($result)) { ?>
                                    <?php 
                                        $major->major_id = $row_m['major_id'];
                                        $result_major = $major->readone();
                                        $row_major = mysqli_fetch_array($result_major);
                                    ?>
                                    <li class="py-2">
                                        <a class="list-style-none" id="pills-<?php echo $row_m['major_id']; ?>-tab" data-toggle="pill" href="#<?php echo $row_m['major_id']; ?>-info" role="tab" aria-controls="pills-setting" aria-selected="true">
                                            <div class="d-flex">
                                                <span class="card-text mb-0"><?php echo $row_major['major_name_th']; ?></span>
                                                <div class="ml-auto">
                                                    <span class="font-medium"><?php echo $row_m['mTotal']; ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="card-body">
                                <!-- sendig message feature is close. Ruchdee 10/12/2020 -->
                                <!-- <div class="row mb-2">
                                    <div class="col-md-9">
                                        <div class="mb-4 ml-2">
                                            <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded" onclick="chk_send_message()"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                    </div>
                                </div> -->
                                <div class="table-responsive">
                                    <table id="alt_pagination" class="table table-striped display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>รหัสนักศึกษา</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>สาขาวิชาเอก</th>
                                                <th>สาขาวิชา</th>
                                                <th class="text-center">รายละเอียด</th>
                                                <!-- <th class="text-center">ส่งข้อความ</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($row = mysqli_fetch_array($result_all)){ ?>
                                            <?php 
                                                //major
                                                $major->major_id = $row['major_id'];
                                                $result_major2 = $major->readone();
                                                $row_major2 = mysqli_fetch_array($result_major2);
                                                //sub major - 25/10/2020 Ruchdee
                                                $major->major_id = $row['sub_major_id'];
                                                $result_sub_major = $major->readone();
                                                $row_sub_major = mysqli_fetch_array($result_sub_major);
                                                //department
                                                $dept->dept_id = $row['dept_id'];
                                                $result_dept = $dept->readone();
                                                $row_dept = mysqli_fetch_array($result_dept);
                                            ?>
                                            <tr>
                                                <!-- <td>
                                                    <div class="n-chk align-self-center text-center">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input contact-chkbox" name="chk_student" id="<?php echo $row['student_id'] ?>" value="<?php echo $row['student_id'] ?>">
                                                            <label class="custom-control-label" name="chk_student" for="<?php echo $row['student_id'] ?>"></label>
                                                        </div>
                                                    </div>
                                                </td> -->
                                                <td><?php echo $row['student_id']; ?></td>
                                                <td><?php echo $row['title_name_thai'];?><?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                <td><?php echo (empty($row['sub_major_id'])) ? $row_major2['major_name_th'] : $row_sub_major['major_name_th']; ?></td>
                                                <td><?php echo $row_dept['dept_name_th']; ?></td>
                                                <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                <!-- sendig message feature is close. Ruchdee 10/12/2020 -->
                                                <!-- <td class="text-center"><a href="#" data-id="<?php echo $row['student_id'] ;?>" onclick="send_icon('<?php echo $row['student_id'] ;?>')" id="icon-chat<?php echo $row['student_id'];?>" class="text-success"><i class="fa fa-comment-alt"></i></a></td> -->
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>รหัสนักศึกษา</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>สาขาวิชาเอก</th>
                                                <th>สาขาวิชา</th>
                                                <th class="text-center">รายละเอียด</th>
                                                <!-- <th class="text-center">ส่งข้อความ</th> -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div> <!--card-body -->
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">ข้อมูลนักศึกษา</h5>
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
                <!-- ============================================================== -->
                <!-- model ค้นหารายชื่อทั้งหมด -->
                <div class="modal fade" id="ChatSearch" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">ค้นหารายชื่อทั้งหมด</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pb-0">
                                <div class="add-contact-box">
                                    <div class="add-contact-content">
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <div class="contact-name">
                                                    <select class="form-control custom-select mr-sm-2" id="select-student" name="scholarship-type-status" required>
                                                        <option value="" selected>--เลือกวิธีการส่งข้อความ--</option>
                                                        <option value="private" id="selected-student">เลือกนักศึกษา</option>
                                                        <option value="group">ส่งแก่นักศึกษาทั้งหมด</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--message to selected student-->
                                        <form action="lec_message_list_op.php" method="post">
                                            <div id="selected-a-student" style="display:none;">
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="student-id">ค้นหานักศึกษา</label>
                                                        <input type="text" name="to_user_id" id="to_user_id" class="form-control" placeholder="รหัสนักศึกษา">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="msg_text">ข้อความ</label>
                                                        <textarea name="msg_text" id="msg_text" cols="30" rows="3" class="form-control" placeholder="ข้อความไม่เกิน 200 ตัวอักษร" required></textarea>
                                                        <button type="submit" name="p_custom_search" class="btn btn-primary form-control" id="p_custom_search" onClick="this.innerText='Sending…';">ส่งข้อความ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--Group message-->
                                        <form action="lec_message_list_op.php" method="post">
                                            <div id="selected-group" style="display:none;">
                                                <div class="row form-group">
                                                    <div class="col-md-8">
                                                        <label for="majors">สาขาวิชา</label>
                                                        <select name="majors" id="majors" class="form-control">
                                                            <option value="all" selected>ทุกสาขา</option>
                                                            <?php while($row = mysqli_fetch_array($get_major)) {?>
                                                                <option value="<?php echo $row['major_id'] ?>" ><?php echo $row['major_name_th']; ?></option> 
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="year_status">ชั้นปี</label>
                                                        <select name="year_status" id="year_status" class="form-control">
                                                            <option value="all" selected>ทุกชั้นปี</option>
                                                            <option value="1">ชั้นปี 1</option>
                                                            <option value="2">ชั้นปี 2</option>
                                                            <option value="3">ชั้นปี 3</option>
                                                            <option value="4">ชั้นปี 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="msg_text">ข้อความ</label>
                                                        <textarea name="g_msg_text" id="g_msg_text" cols="30" rows="3" class="form-control" placeholder="ข้อความไม่เกิน 200 ตัวอักษร" required></textarea>
                                                        <button type="submit" name="g_search" id="g_search" class="btn btn-primary form-control" onClick="this.innerText='Sending…';">ส่งข้อความ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END modal ค้นหารายชื่อทั้งหมด -->
                <!-- START send each student ส่งข้อความให้กับนักศึกษาที่เช็ค-->
                <div class="modal fade" id="send_each_student" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">ส่งข้อความ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="lec_message_list_op.php">
                                <div class="modal-body pb-0">
                                    <div class="add-contact-box">
                                        <div class="add-contact-content">
                                            <!--message to selected student-->
                                            <div class="row form-group" id="selected-a-student">
                                                <div class="col-md-12">
                                                    <label for="to_user_id">ส่งข้อความถึง</label>
                                                    <input type="text" name="multi_to_user_id" id="multi_to_user_id" class="form-control" placeholder="รหัสนักศึกษา" style="overflow:hidden;" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group" id="selected-a-student">
                                                <div class="col-md-12">
                                                    <label for="msg_text">ข้อความ</label>
                                                    <textarea name="chk_msg_text" id="chk_msg_text" cols="30" rows="3" class="form-control" placeholder="ข้อความไม่เกิน 200 ตัวอักษร" required></textarea>
                                                    <button type="submit" name="send_chk_student" class="btn btn-primary form-control" id="chk_search" onClick="this.innerText='Sending…';">ส่งข้อความ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END send each student ส่งข้อความให้กับนักศึกษาที่เช็ค-->
                <!-- send message with icon -->
                <div class="modal fade" id="send-single-modal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">ส่งข้อความ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="lec_message_list_op.php">
                                <div class="modal-body pb-0">
                                    <div class="add-contact-box">
                                        <div class="add-contact-content">
                                            <!--message to selected student-->
                                            <div class="row form-group" id="selected-a-student">
                                                <div class="col-md-12">
                                                    <label for="to_user">ส่งข้อความถึง</label>
                                                    <input type="text" name="to_user_id" id="to_single_user" class="form-control" placeholder="รหัสนักศึกษา" style="overflow:hidden;" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group" id="selected-a-student">
                                                <div class="col-md-12">
                                                    <label for="msg_text">ข้อความ</label>
                                                    <textarea name="msg_text" id="msg_text_icon" cols="30" rows="3" class="form-control" placeholder="ข้อความไม่เกิน 200 ตัวอักษร" required></textarea>
                                                    <button type="submit" name="p_search" class="btn btn-primary form-control" id="p_search" onClick="this.innerText='Sending…';">ส่งข้อความ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END send message with icon -->
                                                
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
    <!-- <script src="../assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="../assets/libs/magnific-popup/meg.init.js"></script> -->
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="../dist/js/logo-text.js"></script>
    <!--Notify-->
    <script src="../dist/js/pages/chat/notify.js" url="lec_message_list_op.php"></script>
    <script>
        $(document).ready(function(){	
            $(document).on('click', '#btn-show', function(e){
                e.preventDefault();
                var student_id = $(this).data('id');   // it will get id of clicked row
                //console.log(stype_id);
                $('#dynamic2-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show();      // load ajax loader
                $.ajax({
                    url: 'student_profile_show.php',
                    type: 'POST',
                    data: 'student_id='+student_id,
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

        //click send message from icon
        function send_icon(id){
            var to_user = id;
            $("#send-single-modal").modal('show');
            $("#send-single-modal #to_single_user").val(to_user);
        }

        //send message check if checkbox is checked or not
        function chk_send_message(){
            var checkbox = document.getElementsByName("chk_student");
            if ($(checkbox).is(':checked')){
                var chk_student = new Array();
                $.each($("input[name='chk_student']:checked"), function(){            
                chk_student.push($(this).val());
                });
                console.log(chk_student);
                $('#send_each_student #multi_to_user_id').val(chk_student);
                $('#send_each_student').modal('show');

            } else{
                $('#ChatSearch').modal('show');
            }
        }

        //hide and show search modal
        $('#select-student').change(function() {
            if ($(this).val() == 'private') {
                $('#selected-a-student').show();
                $('#selected-group').hide();
            } else {
                $('#selected-a-student').hide();
            }
            if($(this).val() == 'group'){
                $('#selected-group').show();
            }else{
                $('#selected-group').hide();
            }
        });
    </script>

</body>

</html>