<?php
	session_start();

	include_once 'dbconnect.php';
	include_once 'tb_student_profile.php';
	include_once 'tb_setting.php';
	include_once 'tb_user.php';				//May 16, 2021 Aj.Ruchdee

    //get connection
    $database = new Database();
	$db_main = $database->getConnection_main();
	$db = $database->getConnection();

    //pass connection to table
	$student = new Studentp($db_main);
	$setting = new Setting($db);

	//read from setting table
	$result_setting = $setting->readone();
	$row_setting = mysqli_fetch_array($result_setting);
	$_SESSION['academic_year'] = $row_setting['academic_year'];
	$_SESSION['semester'] = $row_setting['semester'];

	$tName = $_REQUEST["txtusername"];
	$tPass = $_REQUEST["txtpassword"];
	$datecurrent = date("d/m/Y");

	$wsdl = "https://passport.psu.ac.th/authentication/authentication.asmx?wsdl";
	$client = new SoapClient($wsdl, array(
			"trace" => 1,	// enable trace to view what is happening
			"exceptions" => 0,	// disable exceptions
			"cache_wsdl" => 0)); // disable any caching on the wsdl, encase you alter the wsdl server

	$params = array('username' => $tName,'password' => $tPass);
	$data = $client->Authenticate($params);

	if ($data->AuthenticateResult == 1){
		$staff = $client->GetUserDetails($params);
		$staff_detail = $staff->GetUserDetailsResult;
		$user_id = $staff_detail->string[0];			//id
		$username = $staff_detail->string[1] . " " . $staff_detail->string[2];		//username
		$staff_id = $staff_detail->string[3];
		$id_card = $staff_detail->string[5];
		$fac_id = $staff_detail->string[7];
		$email = $staff_detail->string[13];

		//fac_id = 11 = FMS
		if ($fac_id == 'F11') {
			//staff
			if (substr($staff_id,0,1) != '0') { 
				//read from students table
				$student->student_id = $tName;
				$result = $student->readoneforlogin();
				if ($row = mysqli_fetch_array($result)) {
					$_SESSION['std_id'] = $user_id;
					$_SESSION['std_name'] = $username;
					$_SESSION['std_email'] = $email;
					$_SESSION['std_id_card'] = $id_card;			//Jul 7, 2021 Aj.Ruchdee
					if ($row['profile_img'] != '' ) {
						$_SESSION['profile_img'] = $row['profile_img'];
					} else {
						//default student profile image
						$_SESSION['profile_img'] = "../assets/images/users/default_student_b.jpg";
					}
					header("Location: ../main.php");
					exit;
				} else {
					//3- Only current FMS student can login
					header("Location: ../login.php?msg=cstudentonly");
					exit;
				}
			} else {
				$user = new User($db);
				$user->user_id = $tName;
				$user->user_type = "A";		//admin
				$result_admin = $user->readonewithtype();
				if (mysqli_num_rows($result_admin) > 0) {
					$row_admin = mysqli_fetch_array($result_admin);
					$_SESSION['std_id'] = $user_id;
					$_SESSION['std_name'] = $username;
					$_SESSION['std_email'] = $email;
					$_SESSION['std_id_card'] = $id_card;			//Jul 7, 2021 Aj.Ruchdee
					if ($row_admin['user_img'] != '' ) {
						$_SESSION['profile_img'] = $row_admin['user_img'];
					} else {
						//default admin profile
						$_SESSION['profile_img'] = "../assets/images/users/default_user.jpg";
					}
					header("Location: ../main.php");
				} else {
					//2- Only student can login
					header("Location: ../login.php?msg=studentonly");
					exit;
				}
			}
		} else {
			//3- Only FMS student can register
			header("Location: ../login.php?msg=fmsonly");
			exit;
		}
	} else {
		//1 - username or password incorrect
		header("Location: ../login.php?msg=incorrect");
		exit;
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">