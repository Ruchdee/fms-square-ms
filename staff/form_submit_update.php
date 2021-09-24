<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_form_submission.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $fsubmission = new Form_submission($db);

    //read one record by fsubmission_id
    $fsubmission->fsubmission_id = $_POST['fsubmission_id'];
    $result_update = $fsubmission->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="fsubmission-id" name="fsubmission-id" value="<?php echo $_POST['fsubmission_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-1">
                    <div class="w-100">
                        <input id="fsubmission-remark" name="fsubmission-remark" type="link" placeholder="หมายเหตุ" class="form-control" required maxlength="200" value="<?php echo $row_update['fsubmission_remark']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="fsubmission-1" name="fsubmission-status" value="1" <?php if($row_update['fsubmission_status'] == '1') echo "checked" ?>>
                        <label class="custom-control-label" for="fsubmission-1">รับเอกสารแล้ว</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="fsubmission-2" name="fsubmission-status" value="2" <?php if($row_update['fsubmission_status'] == '2') echo "checked" ?>>
                        <label class="custom-control-label" for="fsubmission-2">กำลังดำเนินการ</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="fsubmission-3" name="fsubmission-status" value="3" <?php if($row_update['fsubmission_status'] == '3') echo "checked" ?>>
                        <label class="custom-control-label" for="fsubmission-3">ติดต่อเจ้าหน้าที่ (074287825)</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="fsubmission-4" name="fsubmission-status" value="4" <?php if($row_update['fsubmission_status'] == '4') echo "checked" ?>>
                        <label class="custom-control-label" for="fsubmission-4">อนุมัติ</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="fsubmission-5" name="fsubmission-status" value="5" <?php if($row_update['fsubmission_status'] == '5') echo "checked" ?>>
                        <label class="custom-control-label" for="fsubmission-5">ไม่อนุมัติ</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
