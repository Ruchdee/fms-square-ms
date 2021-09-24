<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_news.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $news = new News($db);

    $news->news_id = $_POST['news_id'];
    $result_detail = $news->readone();
    $row_detail = mysqli_fetch_array($result_detail);

?>

<div class="compose-box">
    <div class="compose-content">
        <div class="text-muted"><?php echo $row_detail['news_desc']; ?></div>
    </div>
</div>