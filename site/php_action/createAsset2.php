<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
//$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');

if($_POST) {
	// Get the data from the input fields
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
	//$status = $_POST['status']; // Can set in INSERT
	//$activeDate = $_POST['activeDate'];
	//$contractID = $_POST['contractID'];
	//$warrantyID = $_POST['warrantyID'];
	$departmentID = $_POST['departmentID'];
	$siteID = $_POST['siteID'];
	$locationID = $_POST['locationID'];

	// Post the data into the table (may be extra data for status, date, etc.)
	$sql = "INSERT INTO	asset (	assetTagID, 
								assetDescription, 

								purchaseDate, 
								purchaseFrom, 
								cost, 
								categories_id, 
								brand, 
								model, 
								serialNo, 
								
								user_id, 
								status, 
								activeDate, 

								
								departmentID, 
								siteID, 
								locationID)
			VALUES	(	'$assetTagID', 
						'$assetDescription', 

						'$purchaseDate', 
						'$purchaseFrom', 
						'$cost', 
						'$categories_id', 
						'$brand', 
						'$model', 
						'$serialNo', 

						'$user_id', 
						'Available', 
						'$activeDate', 
						
						'$departmentID', 
						'$siteID', 
						'$locationID')";

	$assetID;

	if ($connect->query($sql) === true) {
		$assetID = $connect->insert_id;
		$valid['assetID'] = $assetID;
	}

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";

	/*
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully added";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the asset";
	}
	*/

	/*
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	*/
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);