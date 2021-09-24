<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_scholarship_type.php';
    include_once '../php/tb_scholarship.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $stype = new Scholarship_type($db);
    $scholarhsip = new Scholarship($db);

    //read all active records
    $active_stype = true;
    $result_stype_update = $stype->readall($active_stype);

    $scholarhsip->scholarship_id = $_POST['scholarship_id'];
    $result_update = $scholarhsip->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="scholarship-id" name="scholarship-id" value="<?php echo $_POST['scholarship_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control custom-select" id="scholarship-type" name="scholarship-type" required>
                    <?php
                        while ($row_stype_update = mysqli_fetch_array($result_stype_update)) {
                            if ($row_stype_update['scholarship_type_id'] == $row_update['scholarship_type_id']) {
                                echo "<option value='" . $row_stype_update['scholarship_type_id'] ."' selected>" . $row_stype_update['scholarship_type_name'] . "</option>";
                            } else {
                                echo "<option value='" . $row_stype_update['scholarship_type_id'] ."'>" . $row_stype_update['scholarship_type_name'] . "</option>";
                            }
                        } 
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="scholarship-date" name="scholarship-date" required value="<?php echo $row_update['scholarship_date']; ?>"><span class="validation-text"></span>
            </div>
            <div class="col-md-3">
                <select class="form-control custom-select" id="scholarship-status" name="scholarship-status" required>
                    <option value="1" <?php if ($row_update['scholarship_status']) { echo 'selected'; } ?>>แสดง</option>
                    <option value="0" <?php if (!$row_update['scholarship_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-4">
                    <div class="w-100">
                        <input id="scholarship-name" name="scholarship-name" type="text" placeholder="ชื่อทุนการศึกษา" class="form-control" required maxlength="200" value="<?php echo $row_update['scholarship_name']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mail-subject mb-4">
            <div class="w-100">
                <div id="scholarship-desc-update" class=""></div>
                <textarea id="scholarship-desc-update-txt" name="scholarship-desc-update-txt" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#scholarship-desc-update', {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image', 'code-block']
        ]
        },
        placeholder: 'รายละเอียดทุนการศึกษา...',
        theme: 'snow'  // or 'bubble'
    });

    /* quillUpdate.setContents({
        "ops":[
            {"insert": '<?php echo $row_update['news_desc']; ?>\n'}
        ]
    }); */
    
    var scholarshipdescHTML = '<?php echo $row_update['scholarship_desc']; ?>';
    quillUpdate.root.innerHTML = scholarshipdescHTML;
    //console.log(quillUpdate.root.innerHTML);

    $('#form-update').submit(function() {
        $('#scholarship-desc-update-txt').val(quillUpdate.root.innerHTML.trim());
    });
</script>