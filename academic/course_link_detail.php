<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_link.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $clink = new Course_link($db);

    $clink->section_offer_id = $_POST['section_offer_id'];
    $result_detail = $clink->readone();
    $row_detail = mysqli_fetch_array($result_detail);
?>

<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="text-muted mb-2"><i class="fa fa-link text-info"></i> <strong>ลิงค์รายวิชา (Course Link)</strong></div>
                <div class="text-muted ml-3" style="word-wrap: break-word;">
                <?php 
                    if ($row_detail['course_url'] == 'other') {
                        echo "<a href='" . $row_detail['course_url_other'] . "' target='_blank' class='btn-secondary rounded-pill px-3 p-1 align-items-center'>" . $row_detail['course_url_other'] . "</a>"; 
                    } else {
                        echo "<a href='" . $row_detail['course_url'] . "' target='_blank' class='btn-secondary rounded-pill px-3 p-1 align-items-center'>" . $row_detail['course_url'] . "</a>";
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <div class="text-muted mb-2"><i class="fa fa-link text-info"></i> <strong>ลิงค์เพิ่มรายชื่อนักศึกษา (Invite Student Link)</strong></div>
                        <div class="text-muted ml-3" style="word-wrap: break-word;">
                            <?php 
                                if ($row_detail['invite_url'] == '') {
                                    echo "ไม่ระบุ";
                                } else {
                                    echo "<a href='" . $row_detail['invite_url'] . "' target='_blank' class='btn-secondary rounded-pill px-3 p-1 align-items-center'>" . $row_detail['invite_url'] . "</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <div class="text-muted mb-2"><i class="fa fa-code text-info"></i> <strong>รหัสในการเข้าชั้นเรียน (Invite Student Code)</strong></div>
                        <div class="text-muted ml-3">
                            <?php
                                if ($row_detail['invite_code'] == '') {
                                    echo "ไม่ระบุ";
                                } else {
                                    echo "<span class='btn-warning rounded-pill px-3 p-1 align-items-center'>" . $row_detail['invite_code'] . "</span>"; 
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-2">
                    <div class="w-100">
                        <div class="text-muted mb-2"><i class="fa fa-list-alt text-info"></i> <strong>หมายเหตุ (Remark)</strong></div>
                        <div class="text-muted ml-3" style="word-wrap: break-word;">
                            <?php 
                                if ($row_detail['other_remark'] == '') {
                                    echo "ไม่ระบุ";
                                } else {
                                    echo $row_detail['other_remark']; 
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>