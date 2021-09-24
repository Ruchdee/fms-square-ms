<?php 
class Department {

    //database connection and table name
    private $conn_m;
    private $table_name = "departments";

    //table properties
    public $dept_id;
    public $dept_name_th;
    public $dept_name_en;
    public $dept_status;

    public function __construct($db) {
        $this->conn_m = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE dept_status = 1 ORDER BY dept_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY dept_id";
        }
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE dept_id = '" . $this->dept_id . "'";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }
}

?>