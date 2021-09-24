<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_register_moreless.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $moreless = new Register_moreless($db);

    $moreless->moreless_id = $_POST['moreless_id'];
    $result_detail = $moreless->readone();
    $row_detail = mysqli_fetch_array($result_detail);

?>

<div class="compose-box">
    <div class="compose-content">
        <div class="text-muted mb-3"><strong><?php echo $row_detail['moreless_title']; ?></strong></div>
        <div class="text-muted"><?php echo $row_detail['moreless_desc']; ?></div>
    </div>
</div>