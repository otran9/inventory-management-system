<?php 	

require_once 'core.php';

$contractID = $_POST['contractID'];

$sql = "SELECT	contractID,
				contractTitle,
				description,
				startDate,
				endDate,
				contractNo,
				cost,
				vendor,
				contractPerson,
				phone,
				noOfLicenses,
				isSoftware,
				assetID
		FROM	contract
		WHERE	contractID = $contractID";
$result = $connect->query($sql);

if($result->num_rows > 0) {
	$row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);