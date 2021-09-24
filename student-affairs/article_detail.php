<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_university_life.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $ulife = new University_life($db);

    $ulife->article_id = $_POST['article_id'];
    $result_detail = $ulife->readone();
    $row_detail = mysqli_fetch_array($result_detail);

?>

<div class="compose-box">
    <div class="compose-content">
        <h4 class="font-normal"><?php echo $row_detail['article_name']; ?></h4>
        <div class="text-muted"><?php echo $row_detail['article_desc']; ?></div>
    </div>
</div>