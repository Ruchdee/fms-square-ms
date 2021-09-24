<?php 
class Course_open {

    //database connection and table name
    private $conn;
    private $table_name = "course_open";

    //table properties
    public $section_offer_id;
    public $subject_offer_id;
    public $edu_term;
    public $edu_year;
    public $subject_code;
    public $subject_name_thai;
    public $subject_name_eng;
    public $section;
    public $course_credit;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY section_offer_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE section_offer_id = '" . $this->section_offer_id . "' AND edu_term = '" . $this->edu_term . "' AND edu_year = '" . $this->edu_year . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one by subject_code
    function readonebysubject_code(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE subject_code = '" . $this->subject_code . "' AND edu_term = '" . $this->edu_term . "' AND edu_year = '" . $this->edu_year . "' ORDER by section";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one by subject_name_thai
    function readonebysubject_name_thai(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE subject_name_thai LIKE '%" . $this->subject_name_thai . "%' AND edu_term = '" . $this->edu_term . "' AND edu_year = '" . $this->edu_year . "' ORDER by section_offer_id, section";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one by subject_name_eng
    function readonebysubject_name_eng(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE subject_name_eng LIKE '%" . $this->subject_name_eng . "%' AND edu_term = '" . $this->edu_term . "' AND edu_year = '" . $this->edu_year . "' ORDER by section_offer_id, section";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

}
?>