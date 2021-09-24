<?php 
    session_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_survey.php';
    include_once '../php/tb_survey_register.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $survey = new Course_survey($db);
    $sregister = new Survey_register($db);

    //find record in course_survey table
    $survey->survey_id = $_POST['survey_id'];
    $result_survey = $survey->readone();
    $row_survey = mysqli_fetch_array($result_survey);

    //find record in survey_register table
    $sregister->survey_id = $_POST['survey_id'];
    $sregister->student_id = $_SESSION['std_id'];
    $result_register = $sregister->readone();
    if ($row_register = mysqli_fetch_array($result_register)) {
        $survey_action = "u";
    } else {
        $survey_action = "i";
    }

?>

<input type="hidden" id="survey-id" name="survey-id" value="<?php echo $_POST['survey_id']; ?>">
<input type="hidden" id="survey-action" name="survey-action" value="<?php echo $survey_action; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="text-muted mb-2"><strong><?php echo $row_survey['survey_title']; ?></strong></div>
                <div class="text-muted">ใส่เฉพาะรหัสรายวิชาที่ต้องการลงทะเบียน เช่น 890-001 เป็นต้น</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="course-code1" name="course-code1" type="text" placeholder="รหัสรายวิชา 1" class="form-control" required maxlength="10" value="<?php if ($survey_action=='u') echo $row_register['course_code1']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="course-code2" name="course-code2" type="text" placeholder="รหัสรายวิชา 2" class="form-control" maxlength="10" value="<?php if ($survey_action=='u') echo $row_register['course_code2']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="course-code3" name="course-code3" type="text" placeholder="รหัสรายวิชา 3" class="form-control" maxlength="10" value="<?php if ($survey_action=='u') echo $row_register['course_code3']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="course-code4" name="course-code4" type="text" placeholder="รหัสรายวิชา 4" class="form-control" maxlength="10" value="<?php if ($survey_action=='u') echo $row_register['course_code4']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="course-code5" name="course-code5" type="text" placeholder="รหัสรายวิชา 5" class="form-control" maxlength="10" value="<?php if ($survey_action=='u') echo $row_register['course_code5']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex mail-to mb-3">
                    <div class="w-100">
                        <input id="course-code6" name="course-code6" type="text" placeholder="รหัสรายวิชา 6" class="form-control" maxlength="10" value="<?php if ($survey_action=='u') echo $row_register['course_code6']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to">
                    <div class="w-100">
                        <input id="remark-txt" name="remark-txt" type="text" placeholder="หมายเหตุ" class="form-control" maxlength="200" value="<?php if ($survey_action=='u') echo $row_register['remark']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>