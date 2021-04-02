<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$maintNumber = $_POST['maintNumber'];

if($maintNumber) {
	$sql = "DELETE FROM maintenance WHERE maintNumber = {$maintNumber}";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Deleted";		
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while deleting the maintenance";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST