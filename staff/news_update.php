<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_news.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $news = new News($db);
    $news->news_id = $_POST['news_id'];
    $result = $news->readone();
    $row_update = mysqli_fetch_array($result);

?>
<input type="hidden" id="news-id" name="news-id" value="<?php echo $_POST['news_id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-4">
                <select class="form-control" name="news-type" required>
                    <option value="1" <?php if ($row_update['news_type']=='1') { echo 'selected'; } ?>>ข่าวสาร</option>
                    <option value="2" <?php if ($row_update['news_type']=='2') { echo 'selected'; } ?>>ประกาศ</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" id="news-date" name="news-date" required value="<?php echo $row_update['news_date']; ?>"><span class="validation-text"></span>
            </div>
            <div class="col-md-4">
                <select class="form-control custom-select" id="news-status" name="news-status" required>
                    <option value="" selected>สถานะ...</option>
                    <option value="1" <?php if ($row_update['news_status']=='1') { echo 'selected'; } ?>>แสดง</option>
                    <option value="0" <?php if ($row_update['news_status']=='0') { echo 'selected'; } ?>>ยกเลิก</option>
                </select>  
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-4">
                    <div class="w-100">
                        <input id="news-title" name="news-title" type="text" placeholder="ชื่อเรื่อง" class="form-control" name="news-title" required value="<?php echo $row_update['news_title']; ?>">
                        <span class="validation-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mail-subject mb-4">
            <div class="w-100">
                <div id="newsdescriptionUpdate" class=""></div>
                <textarea id="news-desc-update" name="news-desc-update" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#newsdescriptionUpdate', {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image', 'code-block']
        ]
        },
        placeholder: 'รายละเอียดข่าวสารและประกาศ...',
        theme: 'snow'  // or 'bubble'
    });

    /* quillUpdate.setContents({
        "ops":[
            {"insert": '<?php echo $row_update['news_desc']; ?>\n'}
        ]
    }); */

    var newsdescHTML = '<?php echo $row_update['news_desc']; ?>';
    quillUpdate.root.innerHTML = newsdescHTML;
    //console.log(quillUpdate.root.innerHTML);

    $('#form-update').submit(function() {
        $('#news-desc-update').val(quillUpdate.root.innerHTML.trim());
    });
</script>