<?php 
class Form {

    //database connection and table name
    private $conn;
    private $table_name = "forms";

    //table properties
    public $form_id;
    public $form_type;
    public $form_name;
    public $form_link;
    public $form_desc;
    public $form_date;
    public $form_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($aca) {
        if ($aca) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE form_status = 1 ORDER BY form_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY form_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE form_id = '" . $this->form_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (form_type, form_name, form_link, form_desc, form_date, form_status, created_by, created_date) VALUES (?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss',  $this->form_type, $this->form_name, $this->form_link, $this->form_desc, $this->form_date, $this->form_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET form_type = ?, form_date = ?, form_name = ?, form_link = ?, form_desc = ?, form_status = ? WHERE form_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->form_type, $this->form_date, $this->form_name, $this->form_link, $this->form_desc,  $this->form_status, $this->form_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE form_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->form_id);

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
        return "AF" . str_pad($type_no+1, 2, '0', STR_PAD_LEFT);
    }
    
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