<?php 	
require_once 'core.php';

$sql = "SELECT		warranty.warrantyID,
					warranty.length,
					warranty.expirDate,
					warranty.notes,
					warranty.assetID,
					asset.assetTagID
		FROM 		warranty
		INNER JOIN	asset
		ON			warranty.assetID = asset.assetID";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {
	$active = ""; 

	while($row = $result->fetch_array()) {
		$warrantyID = $row[0];
		$assetTagID = $row[5];

	 	$button = '<!-- Two buttons -->
		<div class="btn-group" style="white-space: nowrap">
			<button class="btn-default btn-custom" type="button" data-toggle="modal" id="editWarrantyModalBtn" data-target="#editWarrantyModal" onclick="editWarranty('.$warrantyID.')"><i class="glyphicon glyphicon-edit"></i> Edit</button>
			
			<button class="btn-danger btn-custom" type="button" data-toggle="modal" data-target="#removeWarrantyModal" id="removeWarrantyModalBtn" onclick="removeWarranty('.$warrantyID.')"><i class="glyphicon glyphicon-trash"></i> Remove</button>
		</div>';

		$output['data'][] = array(
			$row[0], // warranty.warrntyID
			$row[1], // warranty.length
			$row[2], // warranty.expirDate
			$row[3], // warranty.notes
			
			$assetTagID, // asset.assetTagID
			// button
			$button 		
		); 	
	} // /while

} // if num_rows

$connect->close();

echo json_encode($output);