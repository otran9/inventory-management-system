<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$assetID 			= $_POST['assetID']; /* NTRAN-Added*/
	$assetTagID 		= $_POST['editAssetTagID'];
	$assetDescription	= $_POST['editAssetDescription'];
	$assetGeoTags 		= $_POST['editAssetGeoTags'];
	$purchaseDate 		= $_POST['editPurchaseDate'];
	$purchaseFrom 		= $_POST['editPurchaseFrom'];
	$cost 				= $_POST['editCost'];
	$brand 				= $_POST['editBrand'];
	$model 				= $_POST['editModel'];
	$serialNo 			= $_POST['editSerialNo'];
	
	$sql = "UPDATE	asset
			SET		assetTagID			= '$assetTagID',
					assetDescription	= '$assetDescription',
					assetGeoTags		= '$assetGeoTags',
					purchaseDate		= '$purchaseDate',
					purchaseFrom		= '$purchaseFrom',
					cost				= '$cost',
					brand				= '$brand',
					model				= '$model',
					serialNo			= '$serialNo'
			WHERE	assetID				= '$assetID'";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating asset info";
	}
} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
