<?php 
class Course_link {

    //database connection and table name
    private $conn;
    private $table_name = "course_links";

    //table properties
    public $section_offer_id;
    public $lecturer_pers_id;
    public $course_url;
    public $course_url_other;
    public $invite_url;
    public $invite_code;
    //public $course_qrcode;
    public $other_remark;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY section_offer_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one course for update
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE section_offer_id = '" . $this->section_offer_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one course for update, June 18, 2021 Aj.Ruchdee
    function readoneforstaff(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE section_offer_id = '" . $this->section_offer_id . "' AND lecturer_pers_id = '" . $this->lecturer_pers_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (section_offer_id, lecturer_pers_id, course_url, course_url_other, invite_url, invite_code, other_remark, created_by, created_date) VALUES (?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->section_offer_id, $this->lecturer_pers_id, $this->course_url, $this->course_url_other, $this->invite_url, $this->invite_code, $this->other_remark, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET course_url = ?, course_url_other = ?, invite_url = ?, invite_code = ?, other_remark = ?, created_by = ?, created_date = ? WHERE section_offer_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss',  $this->course_url, $this->course_url_other, $this->invite_url, $this->invite_code, $this->other_remark, $this->created_by, $this->created_date, $this->section_offer_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //update()

    //update record, June 18, 2021 Aj.Ruchdee
    function updateforstaff(){
        $query = "UPDATE " . $this->table_name . " SET course_url = ?, course_url_other = ?, invite_url = ?, invite_code = ?, other_remark = ?, created_by = ?, created_date = ? WHERE section_offer_id = ? AND lecturer_pers_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss',  $this->course_url, $this->course_url_other, $this->invite_url, $this->invite_code, $this->other_remark, $this->created_by, $this->created_date, $this->section_offer_id, $this->lecturer_pers_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //update()

    function DateThai($strDate) {
        $strYear = date("Y",strtotime($strDate)) + 543;
        $strMonth = date("n",strtotime($strDate));
        $strDay = date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

}
?>