<?php 
class University_life {

    //database connection and table name
    private $conn;
    private $table_name = "university_life";

    //table properties
    public $article_id;
    public $article_name;
    public $article_desc;
    public $article_date;
    public $article_img;
    public $article_status;
    public $article_by;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE article_status = 1 ORDER BY article_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY article_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE article_id = '" . $this->article_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (article_name, article_desc, article_date, article_img, article_status, article_by, created_by, created_date) VALUES (?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss', $this->article_name, $this->article_desc, $this->article_date, $this->article_img, $this->article_status, $this->article_by, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET article_name = ?, article_desc = ?, article_date = ?, article_img = ?, article_status = ?, article_by = ? WHERE article_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss',  $this->article_name, $this->article_desc, $this->article_date, $this->article_img, $this->article_status, $this->article_by, $this->article_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE article_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->article_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function DateThai($strDate) {
        $strYear = date("Y",strtotime($strDate)) + 543;
        $strMonth = date("n",strtotime($strDate));
        $strDay = date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

}

?>