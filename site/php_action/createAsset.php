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

	$sql = "INSERT INTO asset (	assetTagID,
								assetDescription,
								assetGeoTags,
								purchaseDate,
								purchaseFrom,
								cost,
								brand,
								model,
								serialNo)
			VALUES (			'$assetTagID',
								'$assetDescription',
								'$assetGeoTags',
								'$purchaseDate',
								'$purchaseFrom',
								'$cost',
								'$brand',
								'$model',
								'$serialNo')";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}
	
	/*
	$type = explode('.', $_FILES['assetImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['assetImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['assetImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO asset (product_name, product_image, brand_id, categories_id, quantity, rate, active, status) 
				VALUES ('$productName', '$url', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1)";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
	*/
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST