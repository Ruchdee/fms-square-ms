<?php 
class Lecturer {

    //database connection and table name
    private $conn_m;
    private $table_name = "lecturers";

    //table properties
    public $lecturer_id;
    public $title_th;
    public $title_en;
    public $lecturer_pers_id;               //June 8, 2021  Aj.Ruchdee
    public $lecturer_name_th;
    public $lecturer_name_en;
    public $lecturer_email;
    public $lecturer_phone;
    public $major_id;
    public $lecturer_img;
    public $lecturer_remark;
    public $lecturer_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn_m = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE lecturer_status = 1 ORDER BY major_id, lecturer_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY major_id, lecturer_id";
        }
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }

    //read one record
    function readone() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE lecturer_id = '" . $this->lecturer_id . "'";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }

    //read one record by lecturer_pers_id
    //June 8, 2021  Aj.Ruchdee
    function readonebylecturer_pers_id() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE lecturer_pers_id = '" . $this->lecturer_pers_id . "'";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }

    //update record
    function update_lecturer_profile() {
        $query = "UPDATE " . $this->table_name . " SET lecturer_email = ?, lecturer_phone = ?, lecturer_remark = ?, lecturer_img = ? WHERE lecturer_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn_m, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->lecturer_email, $this->lecturer_phone, $this->lecturer_remark, $this->lecturer_img, $this->lecturer_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

}
?>