<?php 
class News {

    //database connection and table name
    private $conn;
    private $table_name = "news";

    //table properties
    public $news_id;
    public $news_title;
    public $news_desc;
    public $news_type;
    public $news_owner;
    public $news_date;
    public $news_status;
    public $academic_year;
    public $semester;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE news_status = 1 ORDER BY news_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY news_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all for educational services or student affairs
    function readallforunit($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE news_owner = '" . $this->news_owner . "' AND news_status = 1 ORDER BY news_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE news_owner = '" . $this->news_owner . "' ORDER BY news_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all records for a specific academic year and semester
    function readallforacyear_semester() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE academic_year = '" . $this->academic_year . "' AND semester = '" . $this->semester . "' AND news_status = 1 ORDER BY news_id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE news_id = '" . $this->news_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (news_title, news_desc, news_type, news_owner, news_date, news_status, academic_year, semester, created_by, created_date) VALUES (?,?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssss', $this->news_title, $this->news_desc, $this->news_type, $this->news_owner, $this->news_date, $this->news_status, $this->academic_year, $this->semester, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET news_title = ?, news_desc = ?, news_type = ?, news_date = ?, news_status = ? WHERE news_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssss', $this->news_title, $this->news_desc, $this->news_type, $this->news_date, $this->news_status, $this->news_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE news_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->news_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function DateThai($strDate) {
        $strYear = date("Y",strtotime($strDate)) + 543;
        $strMonth = date("n",strtotime($strDate));
        $strDay = date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    function chklatest($pDate) {
        $no_latest_day = 3;
        $_diff = date_diff(date_create($pDate), date_create(date("Y-m-d")));
        if ($_diff->format("%a") <= $no_latest_day) {
            return true;
        } else {
            return false;
        }
    }

    function chklatestall() {
        $no_latest_day = 3;
        $query = "SELECT news_date FROM " . $this->table_name . " ORDER BY news_id DESC";
        $result_chk = mysqli_query($this->conn, $query);
        while ($row_chk = mysqli_fetch_array($result_chk)) {
            $_diff = date_diff(date_create($row_chk['news_date']), date_create(date("Y-m-d")));
            if ($_diff->format("%a") <= $no_latest_day) {
                $latest = true;
                break;
            } else {
                $latest = false;
            }
        }
        return $latest;
    }

}
?>