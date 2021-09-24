<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity_type.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $stype = new Activity_type($db);
    $stype->activity_type_id = $_POST['stype_id'];
    $result = $stype->readone();
    $row_update = mysqli_fetch_array($result);

?>
<input type="hidden" id="activity-type-id" name="activity-type-id" value="<?php echo $_POST['stype_id']; ?>">
<div class="add-contact-box">
    <div class="add-contact-content">
        <div class="row form-group">
            <div class="col-md-12">
                <div class="contact-name">
                    <input type="text" id="activity-type-name" name="activity-type-name" class="form-control" placeholder="ประเภททุนการศึกษา" required value="<?php echo $row_update['activity_type_name']; ?>">
                    <span class="validation-text"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-occupation">
                    <textarea id="activity-type-desc" name="activity-type-desc" class="form-control" rows="3" placeholder="คำอธิบาย"><?php echo $row_update['activity_type_desc']; ?></textarea>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-location">
                    <select class="form-control custom-select mr-sm-2" id="activity-type-status" name="activity-type-status" required>
                        <option value="1" <?php if ($row_update['activity_type_status']) { echo 'selected'; } ?> >ใช้งาน</option>
                        <option value="0" <?php if (!$row_update['activity_type_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                    </select>
                </div>
            </div>
            <div class="col-md-offset-6"></div>
        </div>
    </div>
</div>