<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$length		= $_POST['length'];
	$expirDate 	= $_POST['expirDate'];
	$notes 		= $_POST['notes'];
	$assetID	= $_POST['assetID'];
	
	$sql = "INSERT INTO warranty (	length,
									expirDate,
									notes,
									assetID)
			VALUES (	'$length',
						'$expirDate',
						'$notes',
						'$assetID')";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the warranty";
	}

	$connect->close();

	echo json_encode($valid);
} // /if $_POST