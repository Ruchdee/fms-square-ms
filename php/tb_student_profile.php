<?php 
class Studentp {

    //database connection and table name
    private $conn_m;
	private $table_name = "students";
	
    //table properties
    //students
    public $citizen_id;
	public $title_name_thai;
	public $stud_name_thai;
	public $stud_name_eng;
	public $stud_sname_thai;
	public $stud_sname_eng;
	public $stud_sex_name_thai;
    public $nationality_name_thai;
	public $religion_name_thai;
	public $birth_date;
	public $blood_group_name;
	public $stud_birth_place_foriegn;
	public $admit_year;
	public $year_status;
	public $major_id;
	public $sub_major_id;				//modified 25/10/2020 Ruchdee
	public $dept_id;
	public $study_status;
	public $status_desc_thai;
	public $study_level_name;
	public $cum_gpa;
	public $fund_name;
	public $ent_method_name;
	public $prev_institution_name;
	public $institution_tambon;
	public $institution_amphur;
	public $institution_province;
	public $institution_other_province;
	public $institution_country;
	public $prev_gpa;
	public $eng_score;
    public $status;
    public $grade_status_desc;
	public $deformity_name;
	public $disease;
	public $allergy;
	public $room;
	public $building;
	public $address_no;
	public $moo_no;
	public $trok;
	public $soi;
	public $road;
	public $district;
	public $amphur;
	public $province_name_thai;
	public $province_other;
	public $zip_code;
    public $student_id;
    public $phone;
    public $mobile;
	public $email;
	public $adviser_id;				//modified 25/10/2020 Ruchdee
    public $facebook_id;
    public $line_id;
    public $twitter_id;
    public $youtube_id;
	public $profile_img;
	public $major_name_th;
	public $dept_name_th;

    public function __construct($db) {
        $this->conn_m = $db;
    }
    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " INNER JOIN majors ON students.major_id = majors.major_id
		INNER JOIN departments ON students.dept_id = departments.dept_id WHERE student_id = '" . $this->student_id . "'";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
	}
	
	function readoneforlogin() {
		$query = "SELECT student_id, stud_name_thai, stud_sname_thai, email, profile_img FROM " . $this->table_name . " WHERE student_id = '" . $this->student_id . "'";
		$result = mysqli_query($this->conn_m, $query);
		return $result;
	}

    //update record //
    function update(){
		$query = "UPDATE " . $this->table_name . " SET phone = ?, mobile = ?, email = ?,facebook_id = ?, line_id = ?, twitter_id = ?, youtube_id = ?, profile_img = ? WHERE student_id = ?";
		// statement
		$stmt = mysqli_prepare($this->conn_m, $query);
		mysqli_stmt_bind_param($stmt,'sssssssss',$this->phone, $this->mobile, $this->email,$this->facebook_id, $this->line_id,$this->twitter_id, $this->youtube_id,$this->profile_img, $this->student_id);
		if (mysqli_stmt_execute($stmt)) {
			return true;
		} else {
			return false;
		}
	}

	//get all student
	function get_all_student($year_status, $majors) {
		if ($year_status == "all" &&  $majors == "all") {
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE student_id != '" . $_SESSION['std_id'] . "'";
		} elseif ($year_status != "all" && $majors == "all") {
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE student_id != '" . $_SESSION['std_id'] . "' AND year_status = '" . $year_status . "'";
		} elseif ($year_status == "all" && $majors != "all") { 
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE student_id != '" . $_SESSION['std_id'] . "' AND major_id = '" . $majors . "'";
		} else {
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE student_id != '" . $_SESSION['std_id'] . "' AND year_status = '" . $year_status . "' AND major_id = '" . $majors . "'";
		}
		$result = mysqli_query($this->conn_m,$query);
		return $result;
	}

	//get all student
	function get_all_students_lect($year_status, $majors) {
		if ($year_status == "all" &&  $majors == "all") {
			$query = "SELECT student_id FROM " . $this->table_name;
		} elseif ($year_status != "all" && $majors == "all") {
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE year_status = '" . $year_status . "'";
		} elseif ($year_status == "all" && $majors != "all") { 
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE major_id = '" . $majors . "'";
		} else {
			$query = "SELECT student_id FROM " . $this->table_name . " WHERE year_status = '" . $year_status . "' AND major_id = '" . $majors . "'";
		}
		$result = mysqli_query($this->conn_m, $query);
		return $result;
	}

	//modified 10/12/2020 Ruchdee
	//add condition to count by adviser_id
	function totalStudent() {
        $query = "SELECT COUNT(*) as sTotal FROM " . $this->table_name . " WHERE adviser_id = '" . $this->adviser_id . "'";
		$result = mysqli_query($this->conn_m, $query);
		$row = mysqli_fetch_array($result);
        return $row['sTotal'];
    }

	function totalByMajor() {
        $query = "SELECT major_id, COUNT(*) as mTotal FROM " . $this->table_name . " GROUP BY major_id ORDER BY major_id";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
	}

	//modified 25/10/2020 Ruchdee
	function totalByAdvisor() {
        $query = "SELECT major_id, COUNT(*) as mTotal FROM " . $this->table_name . " WHERE adviser_id = '" . $this->adviser_id . "' GROUP BY major_id ORDER BY major_id";
        $result = mysqli_query($this->conn_m, $query);
        return $result;
	}
	
	function readall() {
		$query = "SELECT student_id, title_name_thai, stud_name_thai, stud_sname_thai, major_id, dept_id FROM " . $this->table_name . " ORDER BY dept_id, major_id, student_id";
		$result = mysqli_query($this->conn_m, $query);
        return $result;
	}

	//modified 25/10/2020 Ruchdee
	function readByAdvisor() {
		$query = "SELECT student_id, title_name_thai, stud_name_thai, stud_sname_thai, major_id, sub_major_id, dept_id FROM " . $this->table_name . " WHERE adviser_id = '" . $this->adviser_id . "' ORDER BY dept_id, major_id, student_id";
		$result = mysqli_query($this->conn_m, $query);
        return $result;
	}
  
	//get profile_img student
	function get_student_img($user){
		$query = "SELECT * FROM " .$this->table_name. " WHERE student_id = '".$user."' ";
		$result = mysqli_query($this->conn_m,$query);
		foreach($result as $row){
			if($row['profile_img']){
				return $row['profile_img'];
			}else{
				if($row['stud_sex_name_thai'] == "ชาย"){
					//return $_SESSION['profile_img'];
					return '../assets/images/users/default_student_b.jpg';
				}else{
					//return $_SESSION['profile_img_g'];
					return '../assets/images/users/default_student_g.jpg';
				}
			}
		}
	}
}

?>