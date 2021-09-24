<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_link.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $clink = new Course_link($db);

    $course_url = array(
        "https://lms2.psu.ac.th/", 
        "https://www.classstart.org",
        "https://www.microsoft.com/th-th/microsoft-teams/",
        "https://edu.google.com/intl/th/products/classroom/",
        "https://th-th.facebook.com",
        "other"
        );
    $course_url_txt = array(
        "https://lms2.psu.ac.th/", 
        "https://www.classstart.org",
        "https://www.microsoft.com/th-th/microsoft-teams/",
        "https://edu.google.com/intl/th/products/classroom/",
        "https://th-th.facebook.com",
        "อื่นๆ โปรดระบุ..."
    );

    //read one record by section_offer_id
    $clink->section_offer_id = $_POST['section_offer_id'];
    $clink->lecturer_pers_id = $_POST['lecturer_id'];
    $result_update = $clink->readoneforstaff();
    if ($row_update = mysqli_fetch_array($result_update)) {
        $course_url_update = $row_update['course_url'];
        $course_url_other_update = $row_update['course_url_other'];
        $invite_url_update = $row_update['invite_url'];
        $invite_code_update = $row_update['invite_code'];
        $other_remark_update = $row_update['other_remark'];
    } else {
        $course_url_update = $course_url[0];
        $course_url_other_update = "";
        $invite_url_update = "";
        $invite_code_update = "";
        $other_remark_update = "";
    }

?>
<input type="hidden" id="section-offer-id" name="section-offer-id" value="<?php echo $_POST['section_offer_id']; ?>">
<input type="hidden" id="lecturer-id" name="lecturer-id" value="<?php echo $_POST['lecturer_id']; ?>">
<div class="add-contact-box">
    <div class="add-contact-content">
        <div class="row form-group">
            <div class="col-md-12">
                <select class="form-control custom-select mr-sm-1" id="course-url" name="course-url" required>
                <?php 
                    $cnt = 0;
                    while ($cnt < count($course_url)) {
                        if ($course_url[$cnt] == $course_url_update) {
                            echo "<option value='" . $course_url[$cnt] . "' selected>" . $course_url_txt[$cnt] . "</option>";
                        } else {
                            echo "<option value='" . $course_url[$cnt] . "'>" . $course_url_txt[$cnt] . "</option>";
                        }
                        $cnt++;
                    }
                ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input id="course-url-other" name="course-url-other" type="url" placeholder="ลิงค์รายวิชา (Course Link)" class="form-control mb-3" maxlength="200" disabled value="<?php echo $course_url_other_update; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input id="invite-url" name="invite-url" type="url" placeholder="ลิงค์เพิ่มรายชื่อนักศึกษา (Invite Student Link)" class="form-control mb-3" maxlength="200" value="<?php echo $invite_url_update; ?>" data-toggle="tooltip" data-placement="top" title="ลิงค์เพิ่มรายชื่อนักศึกษา (Invite Student Link)">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input id="invite-code" name="invite-code" type="text" placeholder="รหัสในการเข้าขั้นเรียน (Invite Student Code)" class="form-control mb-3" maxlength="100" value="<?php echo $invite_code_update; ?>" data-toggle="tooltip" data-placement="top" title="รหัสในการเข้าขั้นเรียน (Invite Student Code)">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <textarea id="other-remark" name="other-remark" rows="5" class="form-control" placeholder="ลิงค์อื่นๆ หรือข้อเสนอแนะในการเข้าเรียนออนไลน์ (Other Links or Instructions)" data-toggle="tooltip" data-placement="top" title="ลิงค์อื่นๆ ข้อเสนอแนะ หรือหมายเหตุ"><?php echo $other_remark_update; ?></textarea>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($("#course-url").find("option:selected").val()=='other') {
            $("#course-url-other").prop("disabled", false);
            $("#course-url-other").prop("required", true);
        }
        $("#course-url").change(function () {
            var optionSelected = $(this).find("option:selected");
            var valueSelected  = optionSelected.val();
            //var textSelected   = optionSelected.text();
            if (valueSelected=='other') {
                $("#course-url-other").prop("disabled", false);
                $("#course-url-other").prop("required", true);
                $("#course-url-other").focus();
            } else {
                $("#course-url-other").prop( "disabled", true);
                $("#course-url-other").prop("required", false);
                $("#course-url-other").val("");
            }
        }); 
    });
</script>