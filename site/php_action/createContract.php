<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$contractTitle	= $_POST['contractTitle'];
	$description 	= $_POST['description'];
	$startDate 		= $_POST['startDate'];
	$endDate 		= $_POST['endDate'];
	$contractNo 	= $_POST['contractNo'];
	$cost			= $_POST['cost'];
	$vendor			= $_POST['vendor'];
	$contractPerson	= $_POST['contractPerson'];
	$phone			= $_POST['phone'];
	$noOfLicenses	= $_POST['noOfLicenses'];
	$isSoftware		= $_POST['isSoftware'];
	$assetTagID		= $_POST['assetTagID'];
	
	$sql = "INSERT INTO contract (	contractTitle,
									description,
									startDate,
									endDate,
									contractNo,
									cost,
									vendor,
									contractPerson,
									phone,
									noOfLicenses,
									isSoftware,
									assetID)
			VALUES (	'$contractTitle',
						'$description',
						'$startDate',
						'$endDate',
						'$contractNo',
						'$cost',
						'$vendor',
						'$contractPerson',
						'$phone',
						'$noOfLicenses',
						'$isSoftware',
						'$assetTagID')";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the contract";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST