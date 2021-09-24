<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_scholarship_type.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $stype = new Scholarship_type($db);
    $stype->scholarship_type_id = $_POST['stype_id'];
    $result = $stype->readone();
    $row_update = mysqli_fetch_array($result);

?>
<input type="hidden" id="scholarship-type-id" name="scholarship-type-id" value="<?php echo $_POST['stype_id']; ?>">
<div class="add-contact-box">
    <div class="add-contact-content">
        <div class="row form-group">
            <div class="col-md-12">
                <div class="contact-name">
                    <input type="text" id="scholarship-type-name" name="scholarship-type-name" class="form-control" placeholder="ประเภททุนการศึกษา" required value="<?php echo $row_update['scholarship_type_name']; ?>">
                    <span class="validation-text"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-occupation">
                    <textarea id="scholarship-type-desc" name="scholarship-type-desc" class="form-control" rows="3" placeholder="คำอธิบาย"><?php echo $row_update['scholarship_type_desc']; ?></textarea>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-location">
                    <select class="form-control custom-select mr-sm-2" id="scholarship-type-status" name="scholarship-type-status" required>
                        <option value="1" <?php if ($row_update['scholarship_type_status']) { echo 'selected'; } ?> >ใช้งาน</option>
                        <option value="0" <?php if (!$row_update['scholarship_type_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                    </select>
                </div>
            </div>
            <div class="col-md-offset-6"></div>
        </div>
    </div>
</div>