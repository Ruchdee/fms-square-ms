<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_scholarship.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $scholarhsip = new Scholarship($db);

    $scholarhsip->scholarship_id = $_POST['scholarship_id'];
    $result_detail = $scholarhsip->readone();
    $row_detail = mysqli_fetch_array($result_detail);

?>

<div class="compose-box">
    <div class="compose-content">
        <div class="text-muted"><?php echo $row_detail['scholarship_desc']; ?></div>
    </div>
</div>