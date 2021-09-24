<?php 
class Activity_type {

    //database connection and table name
    private $conn;
    private $table_name = "activity_types";

    //table properties
    public $activity_type_id;
    public $activity_type_name;
    public $activity_type_desc;
    public $activity_type_owner;
    public $activity_type_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_type_status = 1 ORDER BY activity_type_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_type_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for educational services - Ruchdee 11/12/2020
    function aca_readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_type_owner = 'E' AND activity_type_status = 1 ORDER BY activity_type_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_type_owner = 'E' ORDER BY activity_type_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for student affairs - Ruchdee 11/12/2020
    function act_readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_type_owner = 'S' AND activity_type_status = 1 ORDER BY activity_type_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_type_owner = 'S' ORDER BY activity_type_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_type_id = '" . $this->activity_type_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (activity_type_id, activity_type_name, activity_type_desc, activity_type_owner, activity_type_status, created_by, created_date) VALUES (?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->activity_type_id, $this->activity_type_name, $this->activity_type_desc, $this->activity_type_owner, $this->activity_type_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET activity_type_name = ?, activity_type_desc = ?, activity_type_status = ? WHERE activity_type_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->activity_type_name, $this->activity_type_desc, $this->activity_type_status, $this->activity_type_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE activity_type_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->activity_type_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function get_new_id() {
        //fixed error when adding new record, activity_type_id is repetitive 
        //as a record has been deleted, make counting the number of record not working
        //Aug 8, 2021 - AjRuchdee 
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_type_id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_array($result);
        $num_type_id = substr($row["activity_type_id"],2,2);
        //$type_no = mysqli_num_rows($result);
        $type_no = (int)$num_type_id;
        return "AT" . str_pad($type_no+1, 2, '0', STR_PAD_LEFT);
    }

}
?>