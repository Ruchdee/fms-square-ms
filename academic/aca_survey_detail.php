<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_course_survey.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $survey = new Course_survey($db);

    $survey->survey_id = $_POST['survey_id'];
    $result_detail = $survey->readone();
    $row_detail = mysqli_fetch_array($result_detail);

?>

<div class="compose-box">
    <div class="compose-content">
        <div class="text-muted mb-3"><strong><?php echo $row_detail['survey_title']; ?></strong></div>
        <div class="text-muted"><?php echo $row_detail['survey_desc']; ?></div>
    </div>
</div>