<?php 
class Major {

    //database connection and table name
    private $conn_m;
    private $table_name = "majors";

    //table properties
    public $major_id;
    public $major_name_th;
    public $major_name_en;
    public $dept_id;
    public $major_status;

    public function __construct($db) {
        $this->conn_m = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE major_status = 1 ORDER BY dept_id, major_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY dept_id, major_id";
        }
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE major_id = '" . $this->major_id . "'";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }
    
}
?>