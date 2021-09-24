<?php 
class Register_moreless {

    //database connection and table name
    private $conn;
    private $table_name = "register_moreless";

    //table properties
    public $moreless_id;
    public $moreless_title;
    public $moreless_desc;
    public $moreless_deadline;
    public $moreless_status;
    public $academic_year;
    public $semester;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE moreless_status = 1 ORDER BY moreless_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY moreless_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE moreless_id = " . $this->moreless_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (moreless_title, moreless_desc, moreless_deadline, moreless_status, academic_year, semester, created_by, created_date) VALUES (?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss', $this->moreless_title, $this->moreless_desc, $this->moreless_deadline, $this->moreless_status, $this->academic_year, $this->semester, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET moreless_title = ?, moreless_desc = ?, moreless_deadline = ?, moreless_status = ? WHERE moreless_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->moreless_title, $this->moreless_desc, $this->moreless_deadline, $this->moreless_status, $this->moreless_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE moreless_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->moreless_id);

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

    function chkExpired($deadline) {
        $_diff = date_diff(date_create(date("Y-m-d")), date_create($deadline));
        if ((int)$_diff->format("%R%a") < 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>