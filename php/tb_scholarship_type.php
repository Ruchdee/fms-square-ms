<?php 
class Scholarship_type {

    //database connection and table name
    private $conn;
    private $table_name = "scholarship_types";

    //table properties
    public $scholarship_type_id;
    public $scholarship_type_name;
    public $scholarship_type_desc;
    public $scholarship_type_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE scholarship_type_status = 1 ORDER BY scholarship_type_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY scholarship_type_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE scholarship_type_id = '" . $this->scholarship_type_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (scholarship_type_id, scholarship_type_name, scholarship_type_desc, scholarship_type_status, created_by, created_date) VALUES (?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssss', $this->scholarship_type_id, $this->scholarship_type_name, $this->scholarship_type_desc, $this->scholarship_type_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET scholarship_type_name = ?, scholarship_type_desc = ?, scholarship_type_status = ? WHERE scholarship_type_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->scholarship_type_name, $this->scholarship_type_desc, $this->scholarship_type_status, $this->scholarship_type_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE scholarship_type_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->scholarship_type_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function get_new_id() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        $type_no = mysqli_num_rows($result);
        return "ST" . str_pad($type_no+1, 2, '0', STR_PAD_LEFT);
    }
}
?>