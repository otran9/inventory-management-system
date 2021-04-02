<?php 	

require_once 'core.php';

$maintNumber = $_POST['maintNumber'];

$sql = "SELECT	maintNumber,
				title,
				details,
				dueDate,
				maintBy,
				maintStatus,
				dateCompleted,
				repairsCost,
				repeating,
				assetID
		FROM maintenance
		WHERE maintNumber = $maintNumber";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);