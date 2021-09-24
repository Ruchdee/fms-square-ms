<?php 
class Survey_register {

    //database connection and table name
    private $conn;
    private $table_name = "survey_register";

    //table properties
    public $survey_id;
    public $student_id;
    public $course_code1;
    public $course_code2;
    public $course_code3;
    public $course_code4;
    public $course_code5;
    public $course_code6;
    public $remark;
    public $registered_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE survey_id = " . $this->survey_id . " ORDER BY student_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all course survey registrations for a specific student
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE survey_id = " . $this->survey_id . " AND student_id = '" . $this->student_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (survey_id, student_id, course_code1, course_code2, course_code3, course_code4, course_code5, course_code6, remark, registered_date) VALUES (?,?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssss', $this->survey_id, $this->student_id, $this->course_code1, $this->course_code2, $this->course_code3, $this->course_code4, $this->course_code5, $this->course_code6, $this->remark, $this->registered_date);
        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET course_code1 = ?, course_code2 = ?, course_code3 = ?, course_code4 = ?, course_code5 = ?, course_code6 = ?, remark = ? WHERE survey_id = ? AND student_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss',  $this->course_code1, $this->course_code2, $this->course_code3, $this->course_code4, $this->course_code5, $this->course_code6, $this->remark, $this->survey_id, $this->student_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE survey_id = ? AND student_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 'ss', $this->survey_id, $this->student_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

}

?>