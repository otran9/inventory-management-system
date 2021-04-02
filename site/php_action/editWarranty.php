<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$warrantyID	= $_POST['warrantyID']; // Identify by primary key
	$length		= $_POST['editLength']; // Change with edit values
	$expirDate	= $_POST['editExpirDate'];
	$notes 		= $_POST['editNotes'];
	$assetID	= $_POST['editAssetID'];
	
	$sql = "UPDATE	warranty
			SET		length		= '$length',
					expirDate	= '$expirDate',
					notes		= '$notes',
					assetID		= '$assetID'
			WHERE	warrantyID	= '$warrantyID'";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating warranty info";
	}
} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
