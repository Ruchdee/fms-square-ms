<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_aca_form.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $form = new Form($db);

    //read all active records
    $form->form_id = $_POST['form_id'];
    $result_update = $form->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="form-id" name="form-id" value="<?php echo $_POST['form_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control custom-select" id="form-type" name="form-type" required>
                    <option value="" selected>ประเภทฟอร์ม...</option>
                    <option value="1" <?php if ($row_update['form_type']=='1') { echo 'selected'; } ?>>คำร้องทั่วไป</option>
                    <option value="2" <?php if ($row_update['form_type']=='2') { echo 'selected'; } ?>>ลงทะเบียน</option>
                    <option value="3" <?php if ($row_update['form_type']=='3') { echo 'selected'; } ?>>การสอบ</option>
                    <option value="4" <?php if ($row_update['form_type']=='4') { echo 'selected'; } ?>>สถานภาพ</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="form-date" name="form-date" required value="<?php echo $row_update['form_date']; ?>"><span class="validation-text"></span>
            </div>
            <div class="col-md-3">
                <select class="form-control custom-select" id="form-status" name="form-status" required>
                    <option value="1" <?php if ($row_update['form_status']) { echo 'selected'; } ?>>แสดง</option>
                    <option value="0" <?php if (!$row_update['form_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="form-name" name="form-name" type="text" placeholder="ชื่อแบบฟอร์ม" class="form-control" required maxlength="200" value="<?php echo $row_update['form_name']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="form-link" name="form-link" type="link" placeholder="ลิ้งค์แบบฟอร์ม" class="form-control" required maxlength="200" value="<?php echo $row_update['form_link']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mail-subject mb-4">
            <div class="w-100">
                <div id="form-desc-update" class=""></div>
                <textarea id="form-desc-update-txt" name="form-desc-update-txt" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#form-desc-update', {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image', 'code-block']
        ]
        },
        placeholder: 'รายละเอียดแบบฟอร์ม...',
        theme: 'snow'  // or 'bubble'
    });

    /* quillUpdate.setContents({
        "ops":[
            {"insert": '<?php echo $row_update['news_desc']; ?>\n'}
        ]
    }); */
    
    var formdescHTML = '<?php echo $row_update['form_desc']; ?>';
    quillUpdate.root.innerHTML = formdescHTML;
    //console.log(quillUpdate.root.innerHTML);

    $('#form-update').submit(function() {
        $('#form-desc-update-txt').val(quillUpdate.root.innerHTML.trim());
    });
</script>