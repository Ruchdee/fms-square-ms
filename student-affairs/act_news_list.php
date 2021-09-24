<?php
    session_start();

    //check session - student id, name, e-mail
    $_SESSION['std_id'] = "6210518001";
    $_SESSION['std_name'] = "กนกกาญจน์ หนูนวล";
    $_SESSION['std_email'] = "6210518001@email.psu.ac.th";

    if (!isset($_SESSION['std_id'])) {
        header("Location: login.php");
    }

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
	<title>ข่าวสารและประกาศ-กิจการนักศึกษา | FMS Student Portal</title>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/libs/quill/dist/quill.snow.css">
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
                    <a class="navbar-brand" href="../main.php">
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
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title border-bottom">You have 4 new messanges</div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle"> <span class="profile-status online pull-right"></span> </span>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="rounded-circle"> <span class="profile-status busy pull-right"></span> </span>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="rounded-circle"> <span class="profile-status away pull-right"></span> </span>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link text-dark" href="javascript:void(0);"> <b>See all Notifications</b> <i class="fa fa-angle-right"></i> </a>
                                    </li>
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
                                    <div class="col-lg-3  mb-4">
                                        <h5 class="mb-3">CONTACT US</h5>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email"> </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
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
                                <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="36">
                                <span class="ml-2 font-medium"><?php echo $_SESSION['std_id']; ?></span><span class="fas fa-angle-down ml-2"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="../assets/images/users/1.jpg" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h5 class="mb-0"><?php echo $_SESSION['std_name']; ?></h5>
                                        <p class=" mb-0 text-muted"><?php echo $_SESSION['std_email']; ?></p>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
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
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-school"></i>
                                <span class="hide-menu">บริการการศึกษา</span> 
                                <span class="badge badge-info badge-pill ml-auto mr-3 font-medium px-2 py-1">13</span>
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
                                    <a href="../academic/news_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข่าวสารและประกาศ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="../academic/calendar_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ปฏิทินการศึกษา </span>
                                        <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">update</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
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
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อความ </span>
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
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> อาจารย์ที่ปรึกษาออนไลน์</span>
                                    </a>
                                </li>
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
                                            <a href="email-templete-basic.html" class="sidebar-link">
                                                <i class="mdi mdi-upload"></i>
                                                <span class="hide-menu"> อัพโหลด </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">กิจการนักศึกษา</span>
                                <span class="badge badge-warning badge-pill ml-auto mr-3 font-medium px-2 py-1">8</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="about.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> เกี่ยวกับกิจการนักศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="welfare.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> สวัสดิการนักศึกษา </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="act_news_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข่าวสารและประกาศ </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="scholarship_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ทุนการศึกษา </span>
                                        <span class="badge badge-danger badge-pill ml-auto mr-3 font-medium px-2 py-1">update</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="act_calendar_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ปฏิทินกิจกรรม </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="activity_list.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อมูลกิจกรรม </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> การเข้าร่วมกิจกรรม </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="university_life.php" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ชีวิตในรั้วมหาวิทยาลัย </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> ข้อความ </span>
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
                        <h4 class="font-medium text-uppercase mb-0">ข่าวสารและประกาศ </h4>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="../main.php">หน้าแรก</a></li>
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
				<div class="page-content container-fluid note-has-grid">
					<ul class="nav nav-pills p-3 bg-warning mb-3 rounded-pill align-items-center">
                        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2" id="all-news">
                        <i class="icon-layers mr-1"></i><span class="d-none d-md-block">ทั้งหมด</span></a> 
                        </li>
                        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="news-latest">
                        <i class="icon-bell mr-1"></i><span class="d-none d-md-block">ล่าสุด</span></a> 
                        </li>
                        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="news-only">
                        <i class="icon-share-alt mr-1"></i><span class="d-none d-md-block">ข่าว</span></a> 
                        </li>
                        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="notificatin-only">
                        <i class="icon-tag mr-1"></i><span class="d-none d-md-block">ประกาศ</span></a> 
                        </li>
                    </ul>
                    <div class="tab-content bg-transparent">
                        <div id="note-full-container" class="note-has-grid row">
                            <div class="col-md-4 single-note-item all-news news-latest news-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightgreen"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Book a Ticket for Movie">Book a Ticket for Movie </h5>
                                    <p class="note-date font-12 text-muted">11 March 2009</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis. Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news notificatin-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightblue"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Go for lunch">Go for lunch </h5>
                                    <p class="note-date font-12 text-muted">01 April 2002</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news news-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightgreen"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Meeting with Mr.Jojo">Meeting with Mr.Jojo </h5>
                                    <p class="note-date font-12 text-muted">19 October 2020</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news news-latest notificatin-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightblue"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Give Review for design">Give Review for design </h5>
                                    <p class="note-date font-12 text-muted">02 January 2000</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news notificatin-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightblue"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Nightout with friends">Nightout with friends </h5>
                                    <p class="note-date font-12 text-muted">01 August 1999</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis. Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news news-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightgreen"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Launch new template">Launch new template </h5>
                                    <p class="note-date font-12 text-muted">21 January 2015</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis. Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news news-latest news-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightgreen"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Change a Design">Change a Design </h5>
                                    <p class="note-date font-12 text-muted">25 December 2016</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis. Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 single-note-item all-news notification-only">
                                <div class="card card-body">
                                    <span class="side-stick" style="background-color:lightblue"></span>
                                    <h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="Give review for foods">Give review for foods </h5>
                                    <p class="note-date font-12 text-muted">18 December 2020</p>
                                    <div class="note-content">
                                        <p class="note-inner-content text-muted" data-noteContent="Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis. Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info">รายละเอียด</button>
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
    <!-- ============================================================== -->
    <!-- Google Analytics Code -->
    <!-- ============================================================== -->
</body>

</html>