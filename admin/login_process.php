<?php
	session_start();

    include_once '../php/dbconnect.php';
    include_once '../php/tb_user.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();

    //pass connection to table
	$user = new User($db);
	$user->user_id = $_REQUEST["admin-id"];
	$user->user_type = "A";		//admin
	$result = $user->readonewithtype();

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
	} else {
		//not admin type
		header("Location: login.php?msg=nodata");
		exit;
	}

	$tName = $_REQUEST["admin-id"];
	$tPass = $_REQUEST["admin-passwd"];
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
		if ($fac_id=='F11') {
			//staff = 0
			if (substr($staff_id,0,1) == '0') {
				$_SESSION['admin_id'] = $user_id;
				$_SESSION['admin_name'] = $username;
				$_SESSION['admin_email'] = $email;
				if ($row['user_img'] != '' ) {
					$_SESSION['admin_img'] = $row['user_img'];
				} else {
					//default lecturer profile
					$_SESSION['admin_img'] = "../assets/images/users/default_user.jpg";
				}
				header("Location: setting.php");
				exit;
			} else {
				//2- Only staff
				header("Location: login.php?msg=adminonly");
				exit;
			}
		} else {
			//3- Only FMS staff
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