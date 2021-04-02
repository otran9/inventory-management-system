<?php 	
require_once 'core.php';

$sql = "SELECT		maintenance.maintNumber,
					maintenance.title,
					maintenance.details,
					maintenance.dueDate,
					maintenance.maintBy,
					maintenance.maintStatus,
					maintenance.dateCompleted,
					maintenance.repairsCost,
					maintenance.repeating,
					maintenance.assetID,
					asset.assetTagID
		FROM 		maintenance
		INNER JOIN	asset
		ON			maintenance.assetID = asset.assetID";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {
	// $row = $result->fetch_array();
	$active = ""; 

	while($row = $result->fetch_array()) {
		$maintNumber = $row[0];
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
			<button class="btn-default btn-custom" type="button" data-toggle="modal" id="editMaintModalBtn" data-target="#editMaintModal" onclick="editMaint('.$maintNumber.')"><i class="glyphicon glyphicon-edit"></i> Edit</button>
		
			<button class="btn-danger btn-custom" type="button" data-toggle="modal" data-target="#removeMaintModal" id="removeMaintModalBtn" onclick="removeMaint('.$maintNumber.')"><i class="glyphicon glyphicon-trash"></i> Remove</button>
		</div>';

		/*
		$button = '<!-- Single button -->
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a type="button" data-toggle="modal" id="editMaintModalBtn" data-target="#editMaintModal" onclick="editMaint('.$maintNumber.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				<li><a type="button" data-toggle="modal" data-target="#removeMaintModal" id="removeMaintModalBtn" onclick="removeMaint('.$maintNumber.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
			</ul>
		</div>';
		*/

		$output['data'][] = array(
			$row[1], // title
			$row[2], // details
			$row[3], // dueDate
			$row[4], // maintBy
			$row[5], // maintStatus
			$row[6], // dateCompleted
			$row[7], // repairsCost
			$row[8], // repeating
			
			$row[10], // assetTagID
		
			// button
			$button 		
		); 	
	} // /while

}// if num_rows

$connect->close();

echo json_encode($output);