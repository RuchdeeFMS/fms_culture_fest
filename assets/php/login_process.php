<?php
	session_start();

	//header("Location: index.php");

	$tName=$_REQUEST["form-username"];
	$tPass=$_REQUEST["form-password"];
	$datecurrent = date("d/m/Y");

			 $wsdl = "https://passport.psu.ac.th/authentication/authentication.asmx?wsdl";
						$client = new SoapClient($wsdl,
						array(
						"trace" => 1,	// enable trace to view what is happening
						"exceptions" => 0,	// disable exceptions
						"cache_wsdl" => 0)); // disable any caching on the wsdl, encase you alter the wsdl server

						$params = array('username' => $tName,'password' => $tPass);
						$data = $client->Authenticate($params);

			 	 if ($data->AuthenticateResult == 1){
								$staff =$client->GetUserDetails($params);
								$staff_detail = $staff->GetUserDetailsResult;
								$user=$staff_detail->string[0];
								$staff_id=$staff_detail->string[3];
								$id_card=$staff_detail->string[5];
								$fac_id=$staff_detail->string[7];
								$email=$staff_detail->string[13];

						if (substr($staff_id,0,1) != '0'){ //���������繹ѡ�֡������staff ������� ��.�͡���
								header("Location: ../../index.php");
						} else{
								if ($fac_id=='F11'){
										$_SESSION['username'] = $tName;
										$_SESSION['id_card'] = $id_card;
								}
								$_SESSION['username'] = $tName;
								$_SESSION['id_card'] = $id_card;

								header("Location: ../../scan_qr.php?zone=1");
						}
				} else {
						//redirect('index.php','refresh');
						header("Location: ../../login.php?error=1");
				}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
