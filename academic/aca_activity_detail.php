<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_activity.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $activity = new Activity($db);

    $activity->activity_id = $_POST['activity_id'];
    $result_detail = $activity->readone();
    $row_detail = mysqli_fetch_array($result_detail);

?>

<div class="compose-box">
    <div class="compose-content">
        <div class="text-muted"><?php echo $row_detail['activity_desc']; ?></div>
    </div>
</div>