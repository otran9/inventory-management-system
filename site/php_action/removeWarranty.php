<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$warrantyID = $_POST['warrantyID'];

if($warrantyID) {
	$sql = "DELETE FROM warranty WHERE warrantyID = {$warrantyID}";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Deleted";		
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while deleting the warranty";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST