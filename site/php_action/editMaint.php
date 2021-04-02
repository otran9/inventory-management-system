<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$maintNumber	= $_POST['maintNumber']; // Identify by primary key
	$title 			= $_POST['editTitle']; // Change with edit values
	$details		= $_POST['editDetails'];
	$dueDate 		= $_POST['editDueDate'];
	$maintBy 		= $_POST['editMaintBy'];
	$maintStatus 	= $_POST['editMaintStatus'];
	$dateCompleted	= $_POST['editDateCompleted'];
	$repairsCost	= $_POST['editRepairsCost'];
	$repeating 		= $_POST['editRepeating'];
	$assetTagID		= $_POST['editAssetTagID'];
	
	$sql = "UPDATE	maintenance
			SET		title			= '$title',
					details			= '$details',
					dueDate			= '$dueDate',
					maintBy			= '$maintBy',
					maintStatus		= '$maintStatus',
					dateCompleted	= '$dateCompleted',
					repairsCost		= '$repairsCost',
					repeating		= '$repeating',
					assetID			= '$assetTagID'
			WHERE	maintNumber		= '$maintNumber'";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating maintenance info";
	}
} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
