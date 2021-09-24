<?php 
class Activity_regitser {

    //database connection and table name
    private $conn;
    private $table_name = "activity_register";

    //table properties
    public $activity_id;
    public $student_id;
    public $student_email;                  //Aug 17, 2021 AjRuchdee
    public $student_phone;                  //Aug 17, 2021 AjRuchdee
    public $registered_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $this->activity_id . " ORDER BY student_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all activities for a specific student
    function readoneforstudent(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE student_id = '" . $this->student_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all students for a specific activity
    function readoneforactivity(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $this->activity_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read a record for a specific student & activity
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $this->activity_id . " AND student_id = '" . $this->student_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (activity_id, student_id, student_email, student_phone, registered_date) VALUES (?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->activity_id, $this->student_id, $this->student_email, $this->student_phone, $this->registered_date);
        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    // function update(){
    //     $query = "UPDATE " . $this->table_name . " SET activity_id = ?, student_id = ?, registered_date = ?";
    //     // statement
    //     $stmt = mysqli_prepare($this->conn, $query);
    //     // bind parameters
    //     mysqli_stmt_bind_param($stmt, 'sss',  $this->activity_id, $this->std_id, $this->registered_date);

    //     /* execute prepared statement */
    //     if (mysqli_stmt_execute($stmt)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE activity_id = ? AND student_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 'ss', $this->activity_id, $this->student_id);

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

    //Add time, Aug 29, 2021 Aj.Ruchdee
    function DateTimeThai($strDate) {
        $strYear = date("Y",strtotime($strDate)) + 543;
        $strMonth = date("n",strtotime($strDate));
        $strDay = date("j",strtotime($strDate));
        $strTime = date("H:i:s", strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strTime";
    }

    function cntParticipant($act_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $act_id;
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }

}

?>