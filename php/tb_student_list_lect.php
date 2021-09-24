<?php 

class StudentL {
    private $conn_m;
    //private $table_name = "majors";
    private $table_name = "students";

    public $student_id;
    public $stud_name_thai;
    public $stud_sname_thai;
    public $major_id;
    public $dept_id;
    public $status_desc_thai;
    public $study_status;
    public $major_name_th;
    public $dept_name_th;

    public function __construct($db) {
        $this->conn_m = $db;
    }

    function showlist () {
        /* $query = "SELECT DISTINCT major_name_th,COUNT(*) as total,majors.major_id ,majors.major_name_en,
                   CASE 
                   WHEN major_name_en = 'FINANCE' THEN 'FINANCE'
                   WHEN major_name_en = 'MARKETING' THEN 'MARKETING'
                   WHEN major_name_en = 'BUSINESS INFORMATION SYSTEM' THEN 'BIS'
                   WHEN major_name_en = 'MEETING INCENTIVE CONVENTION AND EXHIBITION MANAGEMENT' THEN 'MICE' 
                   WHEN major_name_en = 'MANAGEMENT (ENLISH PROGRAM)' THEN 'BBA'
                   WHEN major_name_en = 'LOGISTICS MANAGEMENT' THEN 'LOGIS'
                   WHEN major_name_en = 'PUBLIC ADMINISTRATION' THEN 'PA'
                   WHEN majors.major_id = '0494' THEN 'HR' 
                   END AS major
                   FROM majors 
                  INNER JOIN students 
                  ON majors.major_id = students.major_id 
                  WHERE major_name_en = 'FINANCE' 
                  OR major_name_en = 'MARKETING' 
                  OR major_name_en = 'BUSINESS INFORMATION SYSTEM' 
                  OR major_name_en = 'MEETING INCENTIVE CONVENTION AND EXHIBITION MANAGEMENT' 
                  OR major_name_en = 'MANAGEMENT (ENLISH PROGRAM)' 
                  OR major_name_en = 'LOGISTICS MANAGEMENT' 
                  OR major_name_en = 'PUBLIC ADMINISTRATION' 
                  OR majors.major_id = '0494' 
                  GROUP BY major_name_th
                  ORDER BY majors.major_id ASC"; */
        $query = "SELECT major_id, COUNT(*) as mTotal FROM " . $this->table_name . " GROUP BY major_id ORDER BY major_id";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }

    /* function sumlist() {
        $query = "SELECT major_name_th,COUNT(*) as total, SUM(COUNT(*)) OVER() as stotal
                  FROM majors 
                  INNER JOIN students 
                  ON majors.major_id = students.major_id 
                  WHERE major_name_en = 'FINANCE' 
                  OR major_name_en = 'MARKETING' 
                  OR major_name_en = 'BUSINESS INFORMATION SYSTEM' 
                  OR major_name_en = 'MEETING INCENTIVE CONVENTION AND EXHIBITION MANAGEMENT' 
                  OR major_name_en = 'MANAGEMENT (ENLISH PROGRAM)' 
                  OR major_name_en = 'LOGISTICS MANAGEMENT' 
                  OR major_name_en = 'PUBLIC ADMINISTRATION' 
                  OR majors.major_id = '0494'";
        $result2 = mysqli_query($this->conn_m, $query);
        return $result2;
    } */
    
    function sumlist() {
        $query = "SELECT COUNT(*) as stotal FROM students";
        $result2 = mysqli_query($this->conn_m, $query);
        return $result2;
    }
    
    function show_std() {
        //$query = "SELECT student_id FROM students INNER JOIN majors ON students.major_id = majors.major_id INNER JOIN departments ON students.dept_id = departments.dept_id WHERE students.major_id = 'majors.major_id' ";
        $query = "SELECT *, 
                  CASE 
                   WHEN major_name_en = 'FINANCE' THEN 'FINANCE'
                   WHEN major_name_en = 'MARKETING' THEN 'MARKETING'
                   WHEN major_name_en = 'BUSINESS INFORMATION SYSTEM' THEN 'BIS'
                   WHEN major_name_en = 'MEETING INCENTIVE CONVENTION AND EXHIBITION MANAGEMENT' THEN 'MICE' 
                   WHEN major_name_en = 'MANAGEMENT (ENLISH PROGRAM)' THEN 'BBA'
                   WHEN major_name_en = 'LOGISTICS MANAGEMENT' THEN 'LOGIS'
                   WHEN major_name_en = 'PUBLIC ADMINISTRATION' THEN 'PA'
                   WHEN majors.major_id = '0494' THEN 'HR' 
                   END AS major
                  FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  WHERE majors.major_name_en = 'FINANCE' 
                  OR majors.major_name_en = 'MARKETING' 
                  OR majors.major_name_en = 'BUSINESS INFORMATION SYSTEM' 
                  OR majors.major_name_en = 'MEETING INCENTIVE CONVENTION AND EXHIBITION MANAGEMENT' 
                  OR majors.major_name_en = 'MANAGEMENT (ENLISH PROGRAM)' 
                  OR majors.major_name_en = 'LOGISTICS MANAGEMENT' 
                  OR majors.major_name_en = 'PUBLIC ADMINISTRATION' 
                  OR majors.major_id = '0494'
                  ORDER BY majors.major_id ASC,students.student_id DESC";
        $result3 = mysqli_query($this->conn_m, $query);
        return $result3;
    }

   /* function show_std() {
        //$query = "SELECT student_id FROM students INNER JOIN majors ON students.major_id = majors.major_id INNER JOIN departments ON students.dept_id = departments.dept_id WHERE students.major_id = 'majors.major_id' ";
        $query = "SELECT *,

                  FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0491' 
                  OR majors.major_id = '0492' 
                  OR majors.major_id = '0489' 
                  OR majors.major_id = '0488' 
                  OR majors.major_id = '0480' 
                  OR majors.major_id = '0467' 
                  OR majors.major_id = '0465' 
                  OR majors.major_id = '0494'
                  ORDER BY majors.major_id ASC,students.student_id DESC";
        $result3 = mysqli_query($this->conn_m, $query);
        return $result3;
    }*/
    
    function show_std_fin() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0491'";
        $result0491 = mysqli_query($this->conn_m, $query);
        return $result0491;
    }
    
    function show_std_mkt() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0492'";
        $result0492 = mysqli_query($this->conn_m, $query);
        return $result0492;
    }

    function show_std_is() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0489'";
        $result0489 = mysqli_query($this->conn_m, $query);
        return $result0489;
    }

    function show_std_mice() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0488'";
        $result0488 = mysqli_query($this->conn_m, $query);
        return $result0488;
    }

    function show_std_bba() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0480'";
        $result0480 = mysqli_query($this->conn_m, $query);
        return $result0480;
    }

    function show_std_logist() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0467'";
        $result0467 = mysqli_query($this->conn_m, $query);
        return $result0467;
    }

    function show_std_pa() {
        $query = "SELECT * FROM students
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0465'";
        $result0465 = mysqli_query($this->conn_m, $query);
        return $result0465;
    }

    function show_std_hr() {
        $query = "SELECT * FROM students 
                  INNER JOIN majors
                  ON students.major_id = majors.major_id
                  INNER JOIN departments
                  ON students.dept_id = departments.dept_id
                  WHERE majors.major_id = '0494'";
        $result0494 = mysqli_query($this->conn_m, $query);
        return $result0494;
    }

    function show_student_modal() {
        $query =    "SELECT * FROM " . $this->table_name . "
                    INNER JOIN majors
                    ON students.major_id = majors.major_id
                    INNER JOIN departments
                    ON students.dept_id = departments.dept_id
                    WHERE student_id = '" . $_POST['student_id'] . "'";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
    }
}
?>