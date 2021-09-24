<?php 
class Scholarship {

    //database connection and table name
    private $conn;
    private $table_name = "scholarships";

    //table properties
    public $scholarship_id;
    public $scholarship_type_id;
    public $scholarship_name;
    public $scholarship_desc;
    public $scholarship_date;
    public $scholarship_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE scholarship_status = 1 ORDER BY scholarship_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY scholarship_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE scholarship_id = '" . $this->scholarship_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (scholarship_type_id, scholarship_name, scholarship_desc, scholarship_date, scholarship_status, created_by, created_date) VALUES (?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->scholarship_type_id, $this->scholarship_name, $this->scholarship_desc, $this->scholarship_date, $this->scholarship_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET scholarship_type_id = ?, scholarship_name = ?, scholarship_desc = ?, scholarship_date = ?, scholarship_status = ? WHERE scholarship_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssss',  $this->scholarship_type_id, $this->scholarship_name, $this->scholarship_desc, $this->scholarship_date, $this->scholarship_status, $this->scholarship_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE scholarship_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->scholarship_id);

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