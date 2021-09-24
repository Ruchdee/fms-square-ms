<?php 
    session_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_register_moreless.php';
    include_once '../php/tb_moreless_request.php';
    include_once '../php/tb_student_profile.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $ml_register = new Register_moreless($db);
    $ml_request = new Moreless_request($db);
    $student = new Studentp($db_m);

    $student->student_id = $_SESSION['std_id'];
    $result_std = $student->readone();
    $row_std = mysqli_fetch_array($result_std);

    //find record in register_moreless table
    $ml_register->moreless_id = $_POST['moreless_id'];
    $result_reg = $ml_register->readone();
    $row_register = mysqli_fetch_array($result_reg);

    //find record in moreless_request table
    $ml_request->moreless_id = $_POST['moreless_id'];
    $ml_request->student_id = $_SESSION['std_id'];
    $result_req = $ml_request->readone();
    if ($row_req = mysqli_fetch_array($result_req)) {
        $ml_action = "u";
    } else {
        $ml_action = "i";
    }

?>

<input type="hidden" id="moreless-id" name="moreless-id" value="<?php echo $_POST['moreless_id']; ?>">
<input type="hidden" id="moreless-action" name="moreless-action" value="<?php echo $ml_action; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="text-muted"><strong><?php echo $row_register['moreless_title']; ?></strong></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="text-muted">เกรดเฉลี่ยสะสม</div>
                <span class="text-info">&nbsp;&nbsp;&nbsp;<?php echo $row_std['cum_gpa']; ?> </span>
            </div>
            <div class="col-md-8">
                <div class="text-muted">สถานะ</div>
                <span class="text-info">&nbsp;&nbsp;&nbsp;<?php echo $row_std['grade_status_desc']; ?> </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="registered-credits" name="registered-credits" type="number" placeholder="ลงทะเบียนเรียนแล้ว" class="form-control" required min="0" max="50" value="<?php if ($ml_action=='u') { echo $row_req['registered_credits']; } else { echo ""; } ?>" data-toggle="tooltip" data-placement="top" title="ลงทะเบียนเรียนแล้ว (หน่วยกิต)">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="alter-registered-credits" name="alter-registered-credits" type="number" placeholder="ต้องการลงทะเบียนเรียนทั้งสิ้น" class="form-control" required min="0" max="50" value="<?php if ($ml_action=='u') { echo $row_req['alter_registered_credits']; } else { echo ""; } ?>" data-toggle="tooltip" data-placement="top" title="ต้องการลงทะเบียนเรียนทั้งสิ้น (หน่วยกิต)">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <select id="moreless-type" name="moreless-type" placeholder="จำนวนหน่วยกิตรวมมากกว่า/น้อยกว่า" class="form-control" required>
                            <option value=""></option>
                            <option value="m" <?php if ($ml_action=='u' && $row_req['moreless_type']=='m') echo "selected"; ?>>มากกว่ากำหนด</option>
                            <option value="l" <?php if ($ml_action=='u' && $row_req['moreless_type']=='l') echo "selected"; ?>>น้อยกว่ากำหนด</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="moreless-credits" name="moreless-credits" type="text" placeholder="จำนวน" class="form-control" maxlength="10" value="<?php if ($ml_action=='u') { echo $row_req['moreless_credits']; } else { echo "0"; } ?>" readonly data-toggle="tooltip" data-placement="top" title="เกิน/น้อยกว่ากำหนดจำนวน (หน่วยกิต)">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <textarea id="moreless-reason" name="moreless-reason" placeholder="ระบุเหตุผล" class="form-control" rows="3" required data-toggle="tooltip" data-placement="top" title="ระบุเหตุผล"><?php if ($ml_action=='u') echo $row_req['moreless_reason']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Custom JavaScript -->
<script src="../dist/js/custom.min.js"></script>
<script>
    $(document).ready(function(){
        $("#registered-credits").change(function(){
            var reg_credits = $("#registered-credits").val();
            var alter_credits = $("#alter-registered-credits").val();
            $("#moreless-credits").val(Math.abs(reg_credits-alter_credits));
        });
        $("#alter-registered-credits").change(function(){
            var reg_credits = $("#registered-credits").val();
            var alter_credits = $("#alter-registered-credits").val();
            $("#moreless-credits").val(Math.abs(reg_credits-alter_credits));
        });
    });
</script>