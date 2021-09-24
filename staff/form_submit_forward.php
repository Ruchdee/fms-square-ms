<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_lecturer.php';

    //get connection
    $database = new Database();
    $db_main = $database->getConnection_main();

    //pass connection to table
    $lecturer = new Lecturer($db_main);
    //read all active records
    $result_lect = $lecturer->readall(true);

    $title_lect = array(1=>'นาย', 2=>'น.ส.', 3=>'นาง', 4=>'อ.', 5=>'ดร.', 6=>'ผศ.', 7=>'ผศ.ดร.', 8=>'รศ.', 9=>'รศ.ดร.', 10=>'ศ.');

?>
<input type="hidden" id="fsubmission-id" name="fsubmission-id" value="<?php echo $_POST['fsubmission_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-8">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <select class="form-control custom-select" id="lecturer" name="lecturer" required>
                            <option value="0" selected>เลือกผู้ที่ต้องการส่งต่อ</option>
                            <?php
                                while ($row_lect = mysqli_fetch_array($result_lect)) {
                                    echo "<option value='" . $row_lect['lecturer_id'] . "' data-email='" . $row_lect['lecturer_email'] . "'>" . $title_lect[$row_lect['title_th']] . $row_lect['lecturer_name_th'] . "</option>";
                                } 
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <select class="form-control custom-select" id="lecturer-type" name="lecturer-type" required>
                            <option value="1" selected>อาจารย์ที่ปรึกษา</option>
                            <option value="2">อาจารย์ผู้สอน</option>
                            <option value="3">หัวหน้าสาขาวิชา</option>
                            <!-- เพิ่ม ผู้มีอำนาจอนุมัติ และ คณบดี 21/07/2021 Aj.Ruchdee-->
                            <option value="4">ผู้มีอำนาจอนุมัติ</option>
                            <option value="5">คณบดี</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <input id="forward-email" name="forward-email" type="text" placeholder="อีเมล" class="form-control" maxlength="200" value="" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <input id="forward-email2" name="forward-email2" type="text" placeholder="เพิ่มอีเมล 1" class="form-control" maxlength="200" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input id="forward-email3" name="forward-email3" type="text" placeholder="เพิ่มอีเมล 2" class="form-control" maxlength="200" value="">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#lecturer').change(function() {
            var email = $('option:selected',this).data('email');
            $('#forward-email').val(email);
        });
    });
</script>
