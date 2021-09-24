<?php
    session_start();
    ob_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_student_list_lect.php';
    include_once '../php/tb_major.php';
    
    //get connection
    $database = new Database();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $stdl = new StudentL($db_m);
    $major = new Major($db_m);

    $stdl->student_id = $_POST['student_id'];

    //function show
    $result = $stdl->show_student_modal();
    $row = mysqli_fetch_array($result);

    if ($row['profile_img']=='') {
        if ($row['stud_sex_name_thai']=='ชาย') {
            $profile_img = "../assets/images/users/default_student_b.jpg";
        } else if($row['stud_sex_name_thai']=='หญิง') {
            $profile_img = "../assets/images/users/default_student_g.jpg";
        } else {
            $profile_img = "../assets/images/users/default_student_b.jpg";
        }
    } else {
        $profile_img = $row['profile_img'];
    }

    //sub major for BA - 25/10/2020 Ruchdee
    $major->major_id = $row['sub_major_id'];
    $result_sub_major = $major->readone();
    $row_sub_major = mysqli_fetch_array($result_sub_major);

    ob_end_flush();
?>
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="page-content container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"> 
                        <img src="<?php echo $profile_img; ?>" class="rounded-circle" width="150" />
                        <h4 class="card-title mt-2"><?php echo $row['stud_name_thai']; ?> <?php echo $row['stud_sname_thai']; ?></h4>
                        <h6 class="card-subtitle"><?php echo $row['stud_name_eng']; ?> <?php echo $row['stud_sname_eng']; ?></h6>
                        <h5 class="card-subtitle"><?php echo $row['student_id']; ?></h5>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                    </center>
                </div>
                <div>
                    <hr> 
                </div>
                <div class="card-body">
                    <div class="b-r"><strong>อีเมล</strong>
                        <p class="text-muted"><?php echo $row['email']; ?></p>
                    </div>
                    <div class="b-r"><strong>โทรศัพท์มือถือ</strong>
                        <h6><?php echo $row['mobile']; ?></h6>
                    </div>
                    <div class="b-r"><strong>ที่อยู่</strong>
                        <h6>บ้านเลขที่ <?php echo $row['address_no']; ?> หมู่ที่ <?php echo $row['moo_no']; ?> ตรอก <?php echo $row['trok']; ?> ซอย <?php echo $row['soi']; ?> ถนน <?php echo $row['road']; ?> ตำบล <?php echo $row['district']; ?> อำเภอ <?php echo $row['amphur']; ?> จังหวัด <?php echo $row['province_name_thai']; ?> <?php echo $row['zip_code']; ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tabs -->
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="pills-general-tab" data-toggle="pill" href="#general-info" role="tab" aria-controls="pills-setting" aria-selected="true"><i class="icon-settings"></i> ข้อมูลทั่วไป</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-education-tab" data-toggle="pill" href="#education-info" role="tab" aria-controls="pills-setting" aria-selected="false"><i class="icon-settings"></i> ประวัติการศึกษา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-address-tab" data-toggle="pill" href="#address-info" role="tab" aria-controls="pills-setting" aria-selected="false"><i class="icon-settings"></i> ที่อยู่</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-social-tab" data-toggle="pill" href="#social-info" role="tab" aria-controls="pills-setting" aria-selected="false"><i class="icon-settings"></i> ติตต่อ</a>
                    </li>
                </ul>
                <!-- Tabs -->
                <div class="tab-content form-material" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="general-info" role="tabpanel" aria-labelledby="pills-general-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อ-นามสกุล (ไทย)</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['stud_name_thai']; ?> <?php echo $row['stud_sname_thai']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ชื่อ-นามสกุล (Eng)</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['stud_sname_eng'] ?> <?php echo $row['stud_sname_eng']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สาขาวิชาเอก</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo (empty($row['sub_major_id'])) ? $row['major_name_th'] : $row_sub_major['major_name_th']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สาขาวิชา</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['dept_name_th']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสนักศึกษา</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['student_id']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>บัตรประชาชน</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['citizen_id']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>เพศ</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['stud_sex_name_thai']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>สัญชาติ</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['nationality_name_thai']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ศาสนา</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['religion_name_thai']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>หมู่เลือด</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['blood_group_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>วัน-เดือน-ปีเกิด</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['birth_date']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานะ</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['status_desc_thai']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เกรดเฉลี่ยสะสม</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['cum_gpa']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ทุนการศึกษา</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['fund_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โรคประจำตัว</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['disease']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>แพ้ยา</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['allergy']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="education-info" role="tabpanel" aria-labelledby="pills-education-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>โรงเรียน</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['prev_institution_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ที่ตั้งโรงเรียน</label>
                                        <input type="text" class="form-control form-control-line" readonly value="ตำบล <?php echo $row['institution_tambon']; ?> อำเภอ <?php echo $row['institution_amphur']; ?> จังหวัด <?php echo $row['institution_province']; ?> <?php echo $row['institution_country']; ?> ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เกรดเฉลี่ยสะสม</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $row['prev_gpa']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>คะแนน O-Net ภาษาอังกฤษ</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['eng_score']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ระบบการสอบคัดเลือก</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['ent_method_name']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="address-info" role="tabpanel" aria-labelledby="pills-address-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เลขห้อง</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['room']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อาคาร</label>
                                        <input type="text" class="form-control form-control-line" readonly value="<?php echo $row['building']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ที่อยู่</label>
                                        <textarea rows="3" class="form-control form-control-line" readonly>บ้านเลขที่ <?php echo $row['address_no']; ?> หมู่ที่ <?php echo $row['moo_no']; ?> ตรอก <?php echo $row['trok']; ?> ซอย <?php echo $row['soi']; ?> ถนน <?php echo $row['road']; ?> ตำบล <?php echo $row['district']; ?> อำเภอ <?php echo $row['amphur']; ?> จังหวัด <?php echo $row['province_name_thai']; ?> <?php echo $row['zip_code']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="social-info" role="tabpanel" aria-labelledby="pills-social-tab">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>โทรศัพท์บ้าน</label>
                                            <input type="text" class="form-control form-control-line" id=phone name="phone" readonly value="<?php echo $row['phone']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>โทรศัพท์มือถือ</label>
                                            <input type="text" class="form-control form-control-line" id=mobile name="mobile" readonly value="<?php echo $row['mobile']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>อีเมล</label>
                                            <input type="text" class="form-control form-control-line" id=email name="email" readonly value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Facebook ID</label>
                                            <input type="text" class="form-control form-control-line" id=facebook_id name="facebook_id" readonly value="<?php echo $row['facebook_id']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Line ID</label>
                                            <input type="text" class="form-control form-control-line" id=line_id name="line_id" readonly value="<?php echo $row['line_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Twitter ID</label>
                                            <input type="text" class="form-control form-control-line" id=twitter_id name="twitter_id" readonly value="<?php echo $row['twitter_id']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>YouTube ID</label>
                                            <input type="text" class="form-control form-control-line" id='youtube_id' name="youtube_id" readonly value="<?php echo $row['youtube_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->