<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$contractID = $_POST['contractID'];

if($contractID) {
	$sql = "DELETE FROM contract WHERE contractID = {$contractID}";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Deleted";		
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while deleting the contract";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST