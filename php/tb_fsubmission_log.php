<?php 
/* June 3, 2021 Aj.Ruchdee */

class Form_submission_log {

    //database connection and table name
    private $conn;
    private $table_name = "form_submission_logs";

    //table properties
    public $fsubmission_log_id;
    public $fsubmission_id;
    public $fsubmission_log_status;
    public $fsubmission_log_remark;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE fsubmission_id = " . $this->fsubmission_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (fsubmission_id, fsubmission_log_status, fsubmission_log_remark, created_by, created_date) VALUES (?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->fsubmission_id, $this->fsubmission_log_status, $this->fsubmission_log_remark, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

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