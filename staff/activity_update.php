<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity_type.php';
    include_once '../php/tb_activity.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $stype = new Activity_type($db);
    $activity = new Activity($db);

    //read all active records
    $active_stype = true;
    $result_stype_update = $stype->act_readall($active_stype);

    $activity->activity_id = $_POST['activity_id'];
    $result_update = $activity->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="activity-id" name="activity-id" value="<?php echo $_POST['activity_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control custom-select" id="activity-type" name="activity-type" required>
                    <?php
                        while ($row_stype_update = mysqli_fetch_array($result_stype_update)) {
                            if ($row_stype_update['activity_type_id'] == $row_update['activity_type_id']) {
                                echo "<option value='" . $row_stype_update['activity_type_id'] ."' selected>" . $row_stype_update['activity_type_name'] . "</option>";
                            } else {
                                echo "<option value='" . $row_stype_update['activity_type_id'] ."'>" . $row_stype_update['activity_type_name'] . "</option>";
                            }
                        } 
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="activity-date" name="activity-date" required value="<?php echo $row_update['activity_date']; ?>"><span class="validation-text"></span>
            </div>
            <div class="col-md-3">
                <select class="form-control custom-select" id="activity-status" name="activity-status" required>
                    <option value="1" <?php if ($row_update['activity_status']) { echo 'selected'; } ?>>แสดง</option>
                    <option value="0" <?php if (!$row_update['activity_status']) { echo 'selected'; } ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="activity-name" name="activity-name" type="text" placeholder="ชื่อกิจกรรม" class="form-control" required maxlength="200" value="<?php echo $row_update['activity_name']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="activity-hour" name="activity-hour" type="number" placeholder="จำนวนชั่วโมง" class="form-control" required maxlength="200"value="<?php echo $row_update['activity_hour']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="activity-participant" name="activity-participant" type="number" placeholder="จำนวนผู้เข้าร่วม" class="form-control" required maxlength="1000" value="<?php echo $row_update['activity_participant']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3 mt-2">
                    <div class="w-100">
                        <span class="text-info">ใส่ <u>"0"</u> กรณีไม่ต้องการระบุจำนวน</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex mail-to mb-3 mt-2 ml-4">
                    <div class="w-100">
                        <input class="form-check-input" type="checkbox" id="activity-calendar" name="activity-calendar" value="<?php echo $row_update['activity_calendar']; ?>" <?php if ($row_update['activity_calendar']) echo "checked"; ?>>
                        <label class="form-check-label" for="activity-calendar">แสดงในปฏิทิน</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex mail-subject mb-4">
            <div class="w-100">
                <div id="activity-desc-update" class=""></div>
                <textarea id="activity-desc-update-txt" name="activity-desc-update-txt" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#activity-desc-update', {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image', 'code-block']
        ]
        },
        placeholder: 'รายละเอียดกิจกรรม...',
        theme: 'snow'  // or 'bubble'
    });

    /* quillUpdate.setContents({
        "ops":[
            {"insert": '<?php echo $row_update['news_desc']; ?>\n'}
        ]
    }); */
    
    var activitydescHTML = '<?php echo $row_update['activity_desc']; ?>';
    quillUpdate.root.innerHTML = activitydescHTML;
    //console.log(quillUpdate.root.innerHTML);

    $('#form-update').submit(function() {
        $('#activity-desc-update-txt').val(quillUpdate.root.innerHTML.trim());
    });
</script>