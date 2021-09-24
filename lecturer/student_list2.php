<?php
    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_student_list_lect.php';
    include_once '../php/tb_major.php';

    //check session - student id, name, e-mail
    $_SESSION['lecturer_id'] = "ruchdee.bi";
    $_SESSION['lecturer_name'] = "รุชดี บิลหมัด";
    $_SESSION['lecturer_email'] = "ruchdee.b@psu.ac.th";


    if (!isset($_SESSION['lecturer_id'])) {
        header("Location: login.php");
    }
    //get connection
    $database = new Database();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $stdl = new StudentL($db_m);
    $major = new Major($db_m);

    //function show
    $result = $stdl->showlist();
    $result2 = $stdl->sumlist();
    $result3 = $stdl->show_std();
    $result0491 = $stdl->show_std_fin();
    $result0492 = $stdl->show_std_mkt();
    $result0489 = $stdl->show_std_is();
    $result0488 = $stdl->show_std_mice();
    $result0480 = $stdl->show_std_bba();
    $result0467 = $stdl->show_std_logist();
    $result0465 = $stdl->show_std_pa();
    $result0494 = $stdl->show_std_hr();

    ob_end_flush();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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
                            <img src="../assets/images/logos/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logos/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="../assets/images/logos/logo-text.png" alt="homepage" class="dark-logo" />
                             <!-- Light Logo text -->    
                             <img src="../assets/images/logos/logo-light-text.png" class="light-logo" alt="homepage" />
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
                                    <div class="col-lg-3 col-xlg-2 mb-4">
                                        <h5 class="mb-3">CAROUSEL</h5>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container p-0"> <img class="d-block img-fluid" src="../assets/images/big/img1.jpg" alt="First slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container p-0"><img class="d-block img-fluid" src="../assets/images/big/img2.jpg" alt="Second slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container p-0"><img class="d-block img-fluid" src="../assets/images/big/img3.jpg" alt="Third slide"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <h5 class="mb-3">ACCORDION</h5>
                                        <!-- Accordian -->
                                        <div id="accordion" class="accordion">
                                            <div class="card mb-1">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Collapsible Group Item #1
                                                </button>
                                              </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Collapsible Group Item #2
                                                </button>
                                              </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <div class="card-header" id="headingThree">
                                                    <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                  Collapsible Group Item #3
                                                </button>
                                              </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xlg-4 mb-4">
                                        <h5 class="mb-3">LIST STYLE</h5>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 mb-4"></div>
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
                        <li class="nav-item search-box"> 
                            <form class="app-search d-none d-lg-block">
                                <input type="text" class="form-control" placeholder="Search...">
                                <a href="" class="active"><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/users/girl.jpg" alt="user" class="rounded-circle" width="36">
                                <span class="ml-2 font-medium"><?php echo $_SESSION['lecturer_id']; ?></span><span class="fas fa-angle-down ml-2"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="../assets/images/users/girl.jpg" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h5 class="mb-0"><?php echo $_SESSION['lecturer_name']; ?></h5>
                                        <p class=" mb-0 text-muted"><?php echo $_SESSION['lecturer_email']; ?></p>
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
                                <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">new</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link"><i class="mdi mdi-comment-text-outline"></i>
                                <span class="hide-menu"> อาจารย์ที่ปรึกษาออนไลน์ </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-calendar-clock"></i><span class="hide-menu"> ปฏิทิน </span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item">
                                    <a href="aca_calendar_list.php" class="sidebar-link"><i class="mdi mdi-opacity"></i>
                                        <span class="hide-menu"> ปฏิทินการศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="act_calendar_list.php" class="sidebar-link"><i class="mdi mdi-seal"></i>
                                        <span class="hide-menu"> ปฏิทินกิจกรรม </span>
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
                                    <?php while ($row = mysqli_fetch_array($result2)) { ?>
                                        <span class="card-text mb-0">จำนวนนักศึกษาทั้งหมด</span>
                                        <div class="ml-auto">
                                            <span class="font-medium"><?php echo $row['stotal']; ?></span>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </a>
                                <hr>
                                <ul class="nav nav-pills list-style-none">
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
                        <div class="col-lg-9 col-md-8 tab-content" id="pills-tabContent">
                            <!--PA-->
                            <div class="material-card card tab-pane fade" id="PA-info" role="tabpanel" aria-labelledby="pills-PA-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0465)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--HR-->
                            <div class="material-card card tab-pane fade" id="HR-info" role="tabpanel" aria-labelledby="pills-HR-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0494)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--LOGIST-->
                            <div class="material-card card tab-pane fade" id="LOGIS-info" role="tabpanel" aria-labelledby="pills-LOGIS-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0467)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--BBA-->
                            <div class="material-card card tab-pane fade" id="BBA-info" role="tabpanel" aria-labelledby="pills-BBA-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0480)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--MICE-->
                            <div class="material-card card tab-pane fade" id="MICE-info" role="tabpanel" aria-labelledby="pills-MICE-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0488)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--BIS-->
                            <div class="material-card card tab-pane fade" id="BIS-info" role="tabpanel" aria-labelledby="pills-BIS-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0489)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--FINANCE-->
                            <div class="material-card card tab-pane fade" id="FINANCE-info" role="tabpanel" aria-labelledby="pills-FINANCE-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0491)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--MARKETING-->
                            <div class="material-card card tab-pane fade" id="MARKETING-info" role="tabpanel" aria-labelledby="pills-MARKETING-tab">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-9">
                                            <div class="mb-4 ml-2">
                                                <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary btn-rounded"><i class="mdi mdi-message-text font-14"></i> ส่งข้อความ</a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="text-primary text-right">นักศึกษาทั้งหมด</h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="alt_pagination" class="table table-striped display"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php while($row = mysqli_fetch_array($result0492)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="n-chk align-self-center text-center">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input contact-chkbox" id="checkbox1">
                                                                <label class="custom-control-label" for="checkbox1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['title_name_thai'];?>&nbsp;<?php echo $row['stud_name_thai']; ?>&nbsp;<?php echo $row['stud_sname_thai']; ?></td>
                                                    <td><?php echo $row['major_name_th']; ?></td>
                                                    <td><?php echo $row['dept_name_th']; ?></td>
                                                    <td class="text-center"><a class="text-info" href="#" data-toggle="modal" data-target="#showModal" data-id="<?php echo $row['student_id']; ?>" id="btn-show"><i class="fa fa-share-square"></i></a></td>
                                                    <td class="text-center"><a href="#" class="text-success"><i class="fa fa-comment-alt"></i></a></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>รหัสนักศึกษา</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สาขาวิชา</th>
                                                    <th>ภาควิชา</th>
                                                    <th class="text-center">รายละเอียด</th>
                                                    <th class="text-center">ส่งข้อความ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <!--Notify-->
    <script src="../dist/js/pages/chat/notify.js" url="lec_message_list_op.php"></script>

    <!-- ============================================================== -->
    <!-- Google Analytics Code -->
    <!-- ============================================================== -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">-ข้อมูลนักศึกษา</h5>
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
                    <button class="btn btn-danger" data-dismiss="modal">ออก</button>
                </div>
        </div>
    </div>
</div>
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
</script>

</body>

</html>