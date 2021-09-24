<?php 
    session_start();
    
    include_once '../php/dbconnect.php';
    include_once '../php/tb_user.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $user = new User($db);
    $user->user_id = $_POST['user_id'];
    $result = $user->readone();
    $row_update = mysqli_fetch_array($result);

?>
<input type="hidden" id="user-id" name="user-id" value="<?php echo $_POST['user_id']; ?>">
<div class="add-contact-box">
    <div class="add-contact-content">
        <div class="row form-group">
            <div class="col-md-12">
                <div class="contact-name">
                    <input type="text" id="user-id" name="user-id" class="form-control" placeholder="รหัสผู้ใช้งาน" required readonly value="<?php echo $row_update['user_id']; ?>">
                    <span class="validation-text"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="text" id="user-name" name="user-name" class="form-control" placeholder="ชื่อ-นามสกุลผู้ใช้งาน" value="<?php echo $row_update['user_name']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-location">
                    <select class="form-control custom-select mr-sm-2" id="user-type" name="user-type" required>
                        <option value="E" <?php if ($row_update['user_type']=='E') { echo 'selected'; } ?>>งานบริการการศึกษา</option>
                        <option value="S" <?php if ($row_update['user_type']=='S') { echo 'selected'; } ?>>งานกิจการนักศึกษา</option>
                        <option value="A" <?php if ($row_update['user_type']=='A') { echo 'selected'; } ?>>ผู้ดูแลระบบ</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-location">
                    <select class="form-control custom-select mr-sm-2" id="user-status" name="user-status" required>
                        <option value="1" <?php if ($row_update['user_status']) { echo 'selected'; } ?>>ใช้งาน</option>
                        <option value="0" <?php if (!$row_update['user_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="contact-name">
                    <input type="file" class="form-control" id="user-img" name="user-img">
                    <input type="hidden" id="user-img-old" name="user-img-old" value="<?php echo $_SESSION['admin_img']; ?>">
                </div>
            </div>
        </div>
    </div>
</div>