<?php
	session_start();

	include_once '../php/dbconnect.php';
	include_once '../php/tb_user.php';
	include_once '../php/tb_setting.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
	$user = new User($db);
	$setting = new Setting($db);

	$user->user_id = $_REQUEST["staff-id"];
	$result = $user->readone();

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
		//read from setting table
		$result_setting = $setting->readone();
		$row_setting = mysqli_fetch_array($result_setting);
	} else {
		//not exist
		header("Location: login.php?msg=nodata");
		exit;
	}

	$tName = $_REQUEST["staff-id"];
	$tPass = $_REQUEST["staff-passwd"];
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
			//staff = 0
			if (substr($staff_id,0,1) == '0') {
				$_SESSION['staff_id'] = $user_id;
				$_SESSION['staff_name'] = $username;
				$_SESSION['staff_email'] = $email;
				if ($row['user_img'] != '' ) {
					$_SESSION['staff_img'] = $row['user_img'];
				} else {
					//default staff profile image
					$_SESSION['staff_img'] = "../assets/images/users/default_user.jpg";
				}
				$_SESSION['academic_year'] = $row_setting['academic_year'];
				$_SESSION['semester'] = $row_setting['semester'];
				
				if ($row['user_type'] == 'E') {
					header("Location: aca_main.php");
					exit;
				} else if($row['user_type'] == 'S') {
					header("Location: act_main.php");
					exit;
				} else {
					header("Location: login.php?msg=staffonly");
					exit;
				}
			} else {
				//2- Only fms staff
				header("Location: login.php?msg=staffonly");
				exit;
			}
		} else {
			//3- Only FMS student can register
			header("Location: login.php?msg=fmsonly");
			exit;
		}
	} else {
		//1 - username or password incorrect
		header("Location: login.php?msg=incorrect");
		exit;
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">