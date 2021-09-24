<?php 

    include_once '../php/dbconnect.php';
    include_once '../php/tb_form_submission.php';
    include_once '../php/tb_aca_form.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $fsubmission = new Form_submission($db);
    $form = new Form($db);

     //read all active records
     $active_stype = true;
     $result_stype_update = $form->readall($active_stype);
 
     $fsubmission->fsubmission_id = $_POST['fsubmission_id'];
     $result_update = $fsubmission->readone();
     $row_update = mysqli_fetch_array($result_update);

?>

<input type="hidden" id="fsubmission-id" name="fsubmission-id" value="<?php echo $_POST['fsubmission_id']; ?>">
<div class="add-contact-box">
    <div class="add-contact-content">
        <div class="row form-group">
            <div class="col-md-12">
                <div class="contact-name">
                    <select class="form-control custom-select mr-sm-2" id="form_id" name="form_id" required>
                    <?php
                        while ($row_stype_update = mysqli_fetch_array($result_stype_update)) {
                            if ($row_stype_update['form_id'] == $row_update['form_id']) {
                                echo "<option value='" . $row_stype_update['form_id'] ."' selected>" . $row_stype_update['form_name'] . "</option>";
                            } else {
                                echo "<option value='" . $row_stype_update['form_id'] ."'>" . $row_stype_update['form_name'] . "</option>";
                            }
                        } 
                    ?>
                    </select>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <textarea id="fsubmission-remark" name="fsubmission-remark" class="form-control" placeholder="หมายเหตุ" required><?php echo $row_update['fsubmission_remark']; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="contact-name">
                <input type="file" class="form-control" id="fsubmission-filename" name="fsubmission-filename" required value="<?php echo $row_update['fsubmission_filename']; ?>">
            </div>
        </div>
    </div>
</div>