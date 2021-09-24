<?php 
class Activity {

    //database connection and table name
    private $conn;
    private $table_name = "activities";

    //table properties
    public $activity_id;
    public $activity_type_id;
    public $activity_name;
    public $activity_desc;
    public $activity_hour;
    public $activity_date;
    public $academic_year;
    public $activity_owner;
    public $activity_participant;
    public $activity_calendar;                  //Ruchdee, Jan 1,2021 - option for adding into calendar table
    public $activity_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_status = 1 ORDER BY activity_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for educational services - Ruchdee 11/12/2020
    function aca_readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_owner = 'E' AND activity_status = 1 ORDER BY activity_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_owner = 'E' ORDER BY activity_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for student affairs - Ruchdee 11/12/2020
    function act_readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_owner = 'S' AND activity_status = 1 ORDER BY activity_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_owner = 'S' ORDER BY activity_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all active activities for a specific academic year
    function readforacyear() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE academic_year = '" . $this->academic_year . "' AND activity_status = 1 ORDER BY activity_id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all active activities of educational services for a specific academic year
    function aca_readforacyear() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE academic_year = '" . $this->academic_year . "' AND activity_owner = 'E' AND activity_status = 1 ORDER BY activity_id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all active activities of student affairs for a specific academic year
    function act_readforacyear() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE academic_year = '" . $this->academic_year . "' AND activity_owner = 'S' AND activity_status = 1 ORDER BY activity_id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = '" . $this->activity_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (activity_type_id, activity_name, activity_desc, activity_hour, activity_date, academic_year, activity_owner, activity_participant, activity_calendar, activity_status, created_by, created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssssss', $this->activity_type_id, $this->activity_name, $this->activity_desc, $this->activity_hour, $this->activity_date, $this->academic_year, $this->activity_owner, $this->activity_participant, $this->activity_calendar, $this->activity_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET activity_type_id = ?, activity_name = ?, activity_desc = ?, activity_hour = ?, activity_date = ?, activity_participant = ?, activity_calendar = ?, activity_status = ? WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss',  $this->activity_type_id, $this->activity_name, $this->activity_desc, $this->activity_hour, $this->activity_date, $this->activity_participant, $this->activity_calendar, $this->activity_status, $this->activity_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->activity_id);

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

    function chkExpired($act_date) {
        $_diff = date_diff(date_create(date("Y-m-d")), date_create($act_date));
        if ((int)$_diff->format("%R%a") <= 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>