<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$assetID = $_POST['assetID'];

if($assetID) {
	$sql = "DELETE FROM asset WHERE assetID = {$assetID}";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
	$valid['messages'] = "Successfully Deleted";		
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while deleting the asset";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST