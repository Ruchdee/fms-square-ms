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
<div class="add-contact-box">
    <div class="add-contact-content text-left border-bottom">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0"><img src="<?php echo $row_detail['article_img']; ?>" class="rounded" width="50%" /></p>
            </div>
            <div class="col-md-6">
                <p class="mb-0 text-muted"><?php echo $row_detail['article_desc']; ?></p>
            </div>
        </div>
    </div>
</div>