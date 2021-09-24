<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_survey.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $survey = new Course_survey($db);

    //read all active records
    $survey->survey_id = $_POST['survey_id'];
    $result_update = $survey->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="survey-id" name="survey-id" value="<?php echo $_POST['survey_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-6">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <input id="survey-title" name="survey-title" type="text" placeholder="หัวข้อแบบสำรวจ" class="form-control" required maxlength="200" value="<?php echo $row_update['survey_title']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="survey-deadline" name="survey-deadline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="วันสิ้นสุดการสำรวจ" required value="<?php echo $row_update['survey_deadline']; ?>"><span class="validation-text"></span>
            </div>
            <div class="col-md-3">
                <select class="form-control custom-select" id="survey-status" name="survey-status" required>
                    <option value="1" <?php if ($row_update['survey_status']) { echo 'selected'; } ?>>แสดง</option>
                    <option value="0" <?php if (!$row_update['survey_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="d-flex mail-subject mb-4">
            <div class="w-100">
                <div id="survey-desc-update" class=""></div>
                <textarea id="survey-desc-update-txt" name="survey-desc-update-txt" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#survey-desc-update', {
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

    /* quillUpdate.setContents({
        "ops":[
            {"insert": '<?php echo $row_update['news_desc']; ?>\n'}
        ]
    }); */
    
    var formdescHTML = '<?php echo $row_update['survey_desc']; ?>';
    quillUpdate.root.innerHTML = formdescHTML;
    //console.log(quillUpdate.root.innerHTML);

    $('#form-update').submit(function() {
        $('#survey-desc-update-txt').val(quillUpdate.root.innerHTML.trim());
    });
</script>