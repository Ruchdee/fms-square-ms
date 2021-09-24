<?php
	session_start();

	include_once '../php/dbconnect.php';
	include_once '../php/tb_lecturer.php';
	include_once '../php/tb_setting.php';

    //get connection
    $database = new Database();
	$db_m = $database->getConnection_main();
	$db = $database->getConnection();

    //pass connection to table
	$lecturer = new Lecturer($db_m);
	$setting = new Setting($db);

	$tName = $_REQUEST["lect-username"];
	$tPass = $_REQUEST["lect-passwd"];
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
		$user_id = $staff_detail->string[0];			//psu passport ID
		$username = $staff_detail->string[1] . " " . $staff_detail->string[2];		//username
		$staff_id = $staff_detail->string[3];			//lecturer ID
		$id_card = $staff_detail->string[5];
		$fac_id = $staff_detail->string[7];
		$email = $staff_detail->string[13];

		//fac_id = 11 = FMS
		if ($fac_id == 'F11') {
			//staff = 0
			if (substr($staff_id,0,1) == '0') { 
				//find lecturer data in lecturers table
				$lecturer->lecturer_id = $staff_id;
				$result = $lecturer->readone();
				if ($row = mysqli_fetch_array($result)) {
					//assign to sessions
					$_SESSION['lecturer_id'] = $staff_id;
					$_SESSION['lecturer_ppid'] = $user_id;
					$_SESSION['lecturer_name'] = $username;
					$_SESSION['lecturer_email'] = $row['lecturer_email'];
					if ($row['lecturer_img'] != '' ) {
						$_SESSION['lecturer_img'] = $row['lecturer_img'];
					} else {
						//default lecturer profile
						$_SESSION['lecturer_img'] = "../assets/images/users/default_lecturer.png";
					}
					$_SESSION['lecturer_id_card'] = $id_card;			//modified 25/10/2020 Ruchdee
					//read from setting table
					$result_setting = $setting->readone();
					$row_setting = mysqli_fetch_array($result_setting);
					$_SESSION['academic_year'] = $row_setting['academic_year'];
					$_SESSION['semester'] = $row_setting['semester'];

					header("Location: main.php");
					exit;
				} else {
					//no data in lecturers table
					header("Location: login.php?msg=nodata");
					exit;
				}
			} else {
				//Only lecturer can login
				header("Location: login.php?msg=fmsonly");
				exit;
			}
		} else {
			//Only FMS student can register
			header("Location: login.php?msg=fmsonly");
			exit;
		}
	} else {
		//username or password incorrect
		header("Location: login.php?msg=incorrect");
		exit;
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">