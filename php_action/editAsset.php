<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$assetTagID 		= $_POST['assetTagID'];
	$assetDescription 	= $_POST['assetDescription'];
	$assetGeoTags 		= $_POST['assetGeoTags'];
	$purchaseDate 		= $_POST['purchaseDate'];
	$purchaseFrom 		= $_POST['purchaseFrom'];
	$cost 				= $_POST['cost'];
	$brand 				= $_POST['brand'];
	$model 				= $_POST['model'];
	$serialNo 			= $_POST['serialNo'];
				
	$sql = "UPDATE	asset
			SET		assetTagID			= '$assetTagID',
					assetDescription	= '$assetDescription',
					assetGeoTags		= '$assetGeoTags',
					purchaseDate		= '$purchaseDate',
					purchaseFrom		= '$purchaseFrom',
					cost				= '$cost',
					brand				= '$brand',
					model				= '$model',
					serialNo			= '$serialNo',
			WHERE assetTagID = $assetTagID";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating asset info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
