<?php 
    //with parameter - after sucessfully signing in, go to where it calls from
    //without parameter - go to main.php

?>
<!DOCTYPE html>
<html dir="ltr">

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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>เข้าสู่ระบบ | FMS Student Portal</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        #loginform {font-family: 'Sarabun', sans-serif;}
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/background/BG-1-02.png) no-repeat center center;">
            <div class="auth-box on-sidebar">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="assets/images/logos/logo-4.png" alt="logo" /></span>
                        <h4 class="font-medium mb-3">เข้าสู่ระบบด้วย PSU Passport</h4>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3" id="loginform" action="php/login_process.php" method="post">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-md" name="txtusername" id="txtusername" placeholder="รหัสผู้ใช้งาน" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-md" name="txtpassword" id="txtpassword" placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="chkRemember">
                                            <label class="custom-control-label" for="chkRemember">จำรหัสผู้ใช้งานนี้</label>
                                            <a href="https://passport.psu.ac.th/?content=forgetpass" target="_blank" id="to-recover" class="text-dark float-right"><i class="fa fa-lock mr-1"></i> ลืมรหัสผ่าน?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">เข้าสู่ระบบ</button>
                                    </div>
                                    <?php 
                                        if (isset($_GET['msg'])) {
                                            switch ($_GET['msg']) {
                                                case 'cstudentonly':
                                                    echo "<div class='col-xs-12'><h5 class='font-medium text-danger'>สำหรับนักศึกษาปัจจุบันเท่านั้น</h5></div>";
                                                    break;
                                                case 'studentonly': 
                                                    echo "<div class='col-xs-12'><h5 class='font-medium text-danger'>สำหรับนักศึกษาเท่านั้น</h5></div>";
                                                    break;
                                                case 'fmsonly': 
                                                    echo "<div class='col-xs-12'><h5 class='font-medium text-danger'>สำหรับนักศึกษาคณะวิทยาการจัดการเท่านั้น</h5></div>";
                                                    break;
                                                
                                                case 'incorrect':
                                                    echo "<div class='col-xs-12'><h5 class='font-medium text-danger'>รหัสผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง</h5></div>";
                                                    break;
                                            }
                                        }
                                    ?>
                                </div>
                                <!-- <div class="form-group mb-0 mt-2">
                                    <div class="col-sm-12 text-center">
                                        <span class="text-info ml-1">หรือเข้าสู่ระบบด้วย </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                                        <div class="social">
                                            <a href="javascript:void(0)" class="btn btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Microsoft"> <i aria-hidden="true" class="fab fa-microsoft"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fab fa-google"></i> </a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group mb-0 mt-2">
                                    <div class="col-sm-12 text-center">
                                        PSU Passport สำหรับนักศึกษา <a href="https://passport.psu.ac.th/index.php?content=student" target="_blank" class="text-info ml-1"><b>รายละเอียด</b></a>
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-2">
                                    <div class="col-sm-12 text-center">Link สำหรับ <a href="lecturer/login.php" target="_blank" class="text-info">อาจารย์</a> | <a href="staff/login.php" target="_blank" class="text-info">เจ้าหน้าที่</a> | <a href="admin/login.php" target="_blank" class="text-info">ผู้ดูแลระบบ</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="text-center">Link สำหรับ <a href="https://square.fms.psu.ac.th/concurrent-exam/" target="_blank" class="btn waves-effect waves-light btn-rounded btn-outline-success">เข้าระบบยื่นคำร้องกักตัวสอบ</a></div>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <span class="db"><img src="assets/images/logos/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium mb-3">Recover Password</h5>
                        <span>Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row mt-3">
                        <!-- Form -->
                        <form class="col-12" action="#" method="post">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="email" required="" placeholder="Username">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-danger" type="submit" name="action">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        /* $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        }); */
    </script>
    <script>
        $(document).ready(function(){
            //check whether localStorage 'std_id' exist
            if (localStorage.std_id) {
                $("#txtusername").val(localStorage.getItem("std_id"));
                $("#chkRemember").prop("checked", true);
            }
            $("#chkRemember").on("click", function() {
                if($(this).prop("checked") == true){
                    if ($("#txtusername").val() != '') {
                        localStorage.setItem('std_id', $("#txtusername").val());
                        //console.log(localStorage.getItem("std_id"));
                    }
                } else {
                    localStorage.removeItem("std_id");
                }
            });
        });
    </script>
</body>

</html>