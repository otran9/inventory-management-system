<?php 	
require_once 'core.php';
// FOR TABLE VIEW
/*
$sql = "SELECT	asset.assetID,
				asset.assetTagID,
				asset.assetDescription,
				asset.assetGeoTags,
				asset.purchaseDate,
				asset.purchaseFrom,
				asset.cost,
				asset.brand,
				asset.model,
				asset.serialNo
		FROM	asset";
	
*/
$sql = "SELECT		asset.assetID, 
					asset.assetTagID, 
					asset.assetDescription, 
					asset.assetGeoTags, 
					asset.purchaseDate, 
					asset.purchaseFrom, 
					asset.cost, 
					asset.brand, 
					asset.model, 
					asset.serialNo,
					brands.brand_name
		FROM 		asset 
		INNER JOIN 	brands 
		ON 			asset.brand = brands.brand_id";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

	// $row = $result->fetch_array();
	$active = ""; 

	while($row = $result->fetch_array()) {
		$assetID = $row[0];
		$brand_name = $row[10];

		/*
		// active 
		if($row[7] == 1) {
			// activate member
			$active = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$active = "<label class='label label-danger'>Not Available</label>";
		} // /else
		*/

		$button = '<!-- Two buttons -->
		<div class="btn-group" style="white-space: nowrap">
			<button class="btn-default btn-custom" type="button" data-toggle="modal" id="editAssetModalBtn" data-target="#editAssetModal" onclick="editAsset('.$assetID.')"><i class="glyphicon glyphicon-edit"></i> Edit</button>
			
			<button class="btn-danger btn-custom" type="button" data-toggle="modal" data-target="#removeAssetModal" id="removeAssetModalBtn" onclick="removeAsset('.$assetID.')"><i class="glyphicon glyphicon-trash"></i> Remove</button>
		</div>';

		/*
		$button = '<!-- Single button -->
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" id="editAssetModalBtn" data-target="#editAssetModal" onclick="editAsset('.$assetID.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				<li><a type="button" data-toggle="modal" data-target="#removeAssetModal" id="removeAssetModalBtn" onclick="removeAsset('.$assetID.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
		</div>';
		*/

		$output['data'][] = array(
		$row[1], // asset.assetTagID
		$row[2], // asset.assetDescription
		$row[3], // asset.assetGeoTags
		$row[4], // asset.purchaseDate
		$row[5], // asset.purchaseFrom
		$row[6], // asset.cost
		$brand_name,
		//$row[7], // brand
		$row[8], // asset.model
		$row[9], // asset.serialNo

		// button
		$button
		); 	
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output);