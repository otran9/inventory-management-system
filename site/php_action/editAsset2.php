<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$assetID = $_POST['assetID'];

	$assetTagID = $_POST['assetTagID'];
	$assetDescription = $_POST['assetDescription'];
	//$assetGeoTags = $_POST['assetGeoTags'];
	$purchaseDate = $_POST['purchaseDate'];
	$purchaseFrom = $_POST['purchaseFrom'];
	$cost = $_POST['cost'];
	$categories_id = $_POST['categories_id'];
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$serialNo = $_POST['serialNo'];
	//$asset_image = $_POST['asset_image'];
	$user_id = $_POST['user_id'];

	$status = $_POST['status']; // Can set in INSERT
	// Code for checked out status
	if ($user_id != 0) { // If the asset is assigned to a user, its status is checked out
		$status = "Checked Out";
	} else {
		$status = "Active";
	}

	//$activeDate = $_POST['activeDate'];
	//$contractID = $_POST['contractID'];
	//$warrantyID = $_POST['warrantyID'];
	$departmentID = $_POST['departmentID'];
	$siteID = $_POST['siteID'];
	$locationID = $_POST['locationID'];

	/*
	// Get the names of the foreign keys of the asset table
	$foreign = "SELECT	asset.categories_id, 
						asset.brand, 
						brands.brand_name, 
						categories.categories_name
				FROM	asset
				INNER JOIN	brands
				ON	asset.brand = brands.brand_id
				INNER JOIN categories
				ON	asset.categories_id = categories.categories_id
				WHERE	asset.assetID = 'assetID'";

	// Set a query to the foreign data
	$foreignQuery = $foreignConnect->query($foreign);

	// An array of all the foreign keys and names
	$foreignArray = $foreignQuery->fetch_array();

	$brand_name = $foreignArray[2];
	$categories_name = $foreignArray[3];
	*/

	$sql = "UPDATE	asset
			SET	assetTagID = '$assetTagID', 
				assetDescription = '$assetDescription', 

				purchaseDate = '$purchaseDate', 
				purchaseFrom = '$purchaseFrom', 
				cost = '$cost', 
				categories_id = '$categories_id', 
				brand = '$brand', 
				model = '$model', 
				serialNo = '$serialNo', 

				user_id = '$user_id', 
				status = '$status', 



				departmentID = '$departmentID', 
				siteID = '$siteID', 
				locationID = '$locationID'
			WHERE	assetID = {$assetID}";

	$connect->query($sql);	

	$valid['success'] = true;
	$valid['messages'] = "Asset Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);