<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$assetID = $_POST['assetID'];

if($_POST) {
	$sql = "UPDATE	asset
			SET	status = 'Active'
			WHERE	assetID = {$assetID}";

	$connect->query($sql);	

	$valid['success'] = true;
	$valid['messages'] = " Asset successfully scanned";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST

/*
if ($assetID) {
	$sql = "UPDATE asset
			SET	status = 'Checked Out'
			WHERE	assetID = {$assetID}";

	$connect->query($sql);	

	$valid['success'] = true;
	$valid['messages'] = "Asset successfully checked out";		
	
	$connect->close();

	echo json_encode($valid);
}
*/

// echo json_encode($valid);