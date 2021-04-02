<?php 	
require_once 'core.php';

$sql = "SELECT		contract.contractID,
					contract.contractTitle,
					contract.description,
					contract.startDate,
					contract.endDate,
					contract.contractNo,
					contract.cost,
					contract.vendor,
					contract.contractPerson,
					contract.phone,
					contract.noOfLicenses,
					contract.isSoftware,
					contract.assetID,
					asset.assetTagID
		FROM 		contract
		INNER JOIN	asset
		ON			contract.assetID = asset.assetID";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {
	// $row = $result->fetch_array();
	$active = ""; 

	while($row = $result->fetch_array()) {
		$contractID = $row[0];
		$assetTagID = $row[13];

	 	$button = '<!-- Two buttons -->
		<div class="btn-group" style="white-space: nowrap">
			<button class="btn-default btn-custom" type="button" data-toggle="modal" id="editContractModalBtn" data-target="#editContractModal" onclick="editContract('.$contractID.')"><i class="glyphicon glyphicon-edit"></i> Edit</button>
			
			<button class="btn-danger btn-custom" type="button" data-toggle="modal" data-target="#removeContractModal" id="removeContractModalBtn" onclick="removeContract('.$contractID.')"><i class="glyphicon glyphicon-trash"></i> Remove</button>
		</div>';

		/*
		$button = '<!-- Single button -->
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" id="editContractModalBtn" data-target="#editContractModal" onclick="editContract('.$contractID.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				<li><a type="button" data-toggle="modal" data-target="#removeContractModal" id="removeContractModalBtn" onclick="removeContract('.$contractID.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
		</div>';
		*/

		$output['data'][] = array(
			$row[1], // contract.contractTitle
			$row[2], // contract.description
			$row[3],
			$row[4],
			$row[5],
			$row[6],
			$row[7],
			$row[8],
			$row[9],
			$row[10],
			$row[11],
			
			$assetTagID, // asset.assetTagID
			// button
			$button 		
		); 	
	} // /while

}// if num_rows

$connect->close();

echo json_encode($output);