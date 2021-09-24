<?php 
    include_once '../php/dbconnect.php';
    include_once '../php/tb_university_life.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
    $ulife = new University_life($db);

    $ulife->article_id = $_POST['article_id'];
    $result_update = $ulife->readone();
    $row_update = mysqli_fetch_array($result_update);

?>
<input type="hidden" id="article-id" name="article-id" value="<?php echo $_POST['article_id']; ?>">
<div class="add-contact-box">
    <div class="add-contact-content">
        <div class="row form-group">
            <div class="col-md-9">
                <input type="text" id="article-name" name="article-name" class="form-control" placeholder="ชื่อบทความ" required value="<?php echo $row_update['article_name']; ?>">
                <span class="validation-text"></span>
            </div>
            <div class="col-md-3">
                <select class="form-control custom-select" id="article-status" name="article-status" required>
                    <option value="1" <?php if ($row_update['article_status']) { echo "selected"; } ?>>แสดง</option>
                    <option value="0" <?php if (!$row_update['article_status']) { echo "selected"; } ?>>ยกเลิก</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <input type="date" class="form-control" id="article-date" name="article-date" required value="<?php echo $row_update['article_date']; ?>">
                <span class="validation-text"></span>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="article-by" name="article-by" placeholder="ชื่อผู้เขียน" required value="<?php echo $row_update['article_by']; ?>">
                <span class="validation-text"></span>
            </div>
            <div class="col-md-5">
                <input type="file" class="form-control" id="article-img" name="article-img">
                <span class="validation-text"></span>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12 text-left">
                <div id="articledescriptionUpdate" class=""></div>
                <textarea id="article-desc-update" name="article-desc-update" style="display:none"></textarea>
                <span class="validation-text"></span>
            </div>
        </div>
        <div class="row mb-4"></div>
    </div>
</div>

<script>
    var quillUpdate = new Quill('#articledescriptionUpdate', {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['link', 'image', 'code-block']
        ]
        },
        placeholder: 'รายละเอียดบทความ...',
        theme: 'snow'  // or 'bubble'
    });

    var articledescHTML = '<?php echo $row_update['article_desc']; ?>';
    quillUpdate.root.innerHTML = articledescHTML;

    $('#form-update').submit(function() {
        $('#article-desc-update').val(quillUpdate.root.innerHTML.trim());
    });
</script>