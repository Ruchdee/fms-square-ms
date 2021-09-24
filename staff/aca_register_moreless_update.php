<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_register_moreless.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $moreless = new Register_moreless($db);

    //read all active records
    $moreless->moreless_id = $_POST['moreless_id'];
    $result_update = $moreless->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="moreless-id" name="moreless-id" value="<?php echo $_POST['moreless_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-6">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <input id="moreless-title" name="moreless-title" type="text" placeholder="หัวข้อแบบสำรวจ" class="form-control" required maxlength="200" value="<?php echo $row_update['moreless_title']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="moreless-deadline" name="moreless-deadline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="วันสิ้นสุดการสำรวจ" required value="<?php echo $row_update['moreless_deadline']; ?>"><span class="validation-text"></span>
            </div>
            <div class="col-md-3">
                <select class="form-control custom-select" id="moreless-status" name="moreless-status" required>
                    <option value="1" <?php if ($row_update['moreless_status']) { echo 'selected'; } ?>>แสดง</option>
                    <option value="0" <?php if (!$row_update['moreless_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="d-flex mail-subject mb-4">
            <div class="w-100">
                <div id="moreless-desc-update" class=""></div>
                <textarea id="moreless-desc-update-txt" name="moreless-desc-update-txt" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#moreless-desc-update', {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image', 'code-block']
        ]
        },
        placeholder: 'รายละเอียดแบบสำรวจ...',
        theme: 'snow'  // or 'bubble'
    });
    
    var formdescHTML = '<?php echo $row_update['moreless_desc']; ?>';
    quillUpdate.root.innerHTML = formdescHTML;
    //console.log(quillUpdate.root.innerHTML);

    $('#form-update').submit(function() {
        $('#moreless-desc-update-txt').val(quillUpdate.root.innerHTML.trim());
    });
</script>