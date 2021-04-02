<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$contractID		= $_POST['contractID']; // Identify by primary key
	$contractTitle	= $_POST['editContractTitle']; // Change with edit values
	$description	= $_POST['editDescription'];
	$startDate 		= $_POST['editStartDate'];
	$endDate 		= $_POST['editEndDate'];
	$contractNo 	= $_POST['editContractNo'];
	$cost			= $_POST['editCost'];
	$vendor			= $_POST['editVendor'];
	$contractPerson	= $_POST['editContractPerson'];
	$phone			= $_POST['editPhone'];
	$noOfLicenses	= $_POST['editNoOfLicenses'];
	$isSoftware 	= $_POST['editIsSoftware'];
	$assetTagID		= $_POST['editAssetTagID'];
	
	$sql = "UPDATE	contract
			SET		contractTitle	= '$contractTitle',
					description		= '$description',
					startDate		= '$startDate',
					endDate			= '$endDate',
					contractNo		= '$contractNo',
					cost			= '$cost',
					vendor			= '$vendor',
					contractPerson	= '$contractPerson',
					phone			= '$phone',
					noOfLicenses	= '$noOfLicenses',
					isSoftware		= '$isSoftware',
					assetID			= '$assetTagID'
			WHERE	contractID		= '$contractID'";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating contract info";
	}
} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
