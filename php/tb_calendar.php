<?php
class Calendar {

    //database connection and table name
    private $conn;
    private $table_name = "calendar";

    //table properties
    public $calendar_id;
    public $calendar_title;
    public $calendar_desc;
    public $start_date;
    public $end_date;
    public $start_time;
    public $end_time;
    public $calendar_owner;
    public $activity_id;                        //Ruchdee, Jan 1,2021
    public $academic_year;
    public $semester;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY calendar_id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for a specific academic year and semester
    function readallforacyear_semester() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE academic_year = '" . $this->academic_year . "' AND semester = '" . $this->semester . "' ORDER BY calendar_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for a specific unit
    function readallforunit() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE calendar_owner = '" . $this->calendar_owner . "' ORDER BY calendar_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read for a specific activity_id, Ruchdee 01/01/2021
    function readonebyactivity() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $this->activity_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (calendar_title, calendar_desc, start_date, end_date, start_time, end_time, calendar_owner, activity_id, academic_year, semester, created_by, created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssssss', $this->calendar_title, $this->calendar_desc, $this->start_date, $this->end_date, $this->start_time, $this->end_time, $this->calendar_owner, $this->activity_id, $this->academic_year, $this->semester, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET calendar_title = ?, calendar_desc = ?, start_date = ?, end_date = ?, start_time = ?, end_time = ? WHERE calendar_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->calendar_title, $this->calendar_desc, $this->start_date, $this->end_date, $this->start_time, $this->end_time, $this->calendar_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //update event date
    function update_eventdate(){
        $query = "UPDATE " . $this->table_name . " SET start_date = ?, end_date = ? WHERE calendar_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->start_date, $this->end_date, $this->calendar_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //update record by activity_id              //Ruchdee 01/01/2021
    function updatebyactivity(){
        $query = "UPDATE " . $this->table_name . " SET calendar_title = ?, calendar_desc = ?, start_date = ?, end_date = ? WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->calendar_title, $this->calendar_desc, $this->start_date, $this->end_date, $this->activity_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE calendar_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->calendar_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record by activity_id              //Ruchdee 01/01/2021
    function deletebyactivity(){
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
    
}

?>