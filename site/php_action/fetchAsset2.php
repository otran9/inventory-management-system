<?php 	
require_once 'core.php';
// FOR TABLE VIEW

$sql = "SELECT	asset.assetID, 
				asset.assetTagID, 
				asset.assetDescription, 
				asset.assetGeoTags, 
				asset.purchaseDate, 
				asset.purchaseFrom, 
				asset.cost, 
				asset.categories_id, 
				asset.brand, 
				asset.model, 
				asset.serialNo, 
				asset.status, 
				brands.brand_name, 
				categories.categories_name
		FROM	asset 
		INNER JOIN	brands 
		ON	asset.brand = brands.brand_id
		INNER JOIN	categories
		ON	asset.categories_id = categories.categories_id";

/*
0 asset.assetID, 
1 asset.assetTagID, 
2 asset.assetDescription, 
3 asset.assetGeoTags, 
4 asset.purchaseDate, 
5 asset.purchaseFrom, 
6 asset.cost, 
7 asset.categories_id, 
8 asset.brand, 
9 asset.model, 
10 asset.serialNo, 
11 asset.status, 
12 brands.brand_name
13 categories.categories_name
*/

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$active = ""; 

	while($row = $result->fetch_array()) {
 		$assetID = $row[0];
 		$status = $row[11];
 		$brand_name = $row[12];
 		$categories_name = $row[13];

 		if ($row[11] == "Available") {
 			$status = "<label class='label label-success'>Available</label>";
 		} else if ($row[11] == "Checked Out") {
 			$status = "<label class='label label-warning'>Checked Out</label>";
 		} else if ($row[11] == "Active") {
 			$status = "<label class='label label-primary'>Active</label>";
 		}

		$button = '<!-- Dropdown -->
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" data-target="#checkOutAssetModal" id="checkOutAssetModalBtn" onclick="checkOutAsset('.$assetID.')"><i class="glyphicon glyphicon-ok-sign"></i> Check Out</a></li>
				<!--
				-->
				
				<li><a type="button" data-toggle="modal" data-target="#scanAssetModal" id="scanAssetModalBtn" onclick="scanAsset('.$assetID.')"><i class="glyphicon glyphicon-barcode"></i> Scan</a></li>

				<li><a href="asset2.php?a=editAsset&i='.$assetID.'" id="editAssetModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				<li><a type="button" data-toggle="modal" data-target="#removeAssetModal" id="removeAssetModalBtn" onclick="removeAsset('.$assetID.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
		</div>';

 		$output['data'][] = array(
			$row[1], // assetTagID
			$row[2], 
			$row[3], // GeoTags
			$row[4], // purchaseDate
			$row[5], // purhcaseFrom
			$categories_name, 
			$row[6], // cost
			$brand_name, 
			$row[9], 
			$row[10], // serialNo
			$status,
		
	 		// button
	 		$button 		
	 	); 	
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output);