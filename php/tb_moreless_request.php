<?php 
class Moreless_request {

    //database connection and table name
    private $conn;
    private $table_name = "moreless_request";

    //table properties
    public $moreless_id;
    public $student_id;
    public $registered_credits;
    public $alter_registered_credits;
    public $moreless_type;
    public $moreless_credits;
    public $moreless_reason;
    public $moreless_filename;
    public $registered_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records for moreless_id
    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE moreless_id = " . $this->moreless_id . " ORDER BY registered_date DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all course survey registrations for a specific student
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE moreless_id = " . $this->moreless_id . " AND student_id = '" . $this->student_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (moreless_id, student_id, registered_credits, alter_registered_credits, moreless_type, moreless_credits, moreless_reason, moreless_filename, registered_date) VALUES (?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->moreless_id, $this->student_id, $this->registered_credits, $this->alter_registered_credits, $this->moreless_type, $this->moreless_credits, $this->moreless_reason, $this->moreless_filename, $this->registered_date);
        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET registered_credits = ?, alter_registered_credits = ?, moreless_type = ?, moreless_credits = ?, moreless_reason = ?, moreless_filename = ? WHERE moreless_id = ? AND student_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss',  $this->registered_credits, $this->alter_registered_credits, $this->moreless_type, $this->moreless_credits, $this->moreless_reason, $this->moreless_filename, $this->moreless_id, $this->student_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE moreless_id = ? AND student_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 'ss', $this->moreless_id, $this->student_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function DateThai($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strTime = date("H:i:s", strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strTime";
    }
    
}
?>