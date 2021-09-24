<?php 
class Setting {

    //database connection and table name
    private $conn;
    private $table_name = "settings";

    //table properties
    public $academic_year;
    public $semester;
    public $updated_by;
    public $updated_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET academic_year = ?, semester = ?, updated_by = ?, updated_date = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->academic_year, $this->semester, $this->updated_by, $this->updated_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
?>