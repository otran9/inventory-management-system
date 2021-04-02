<?php 	

require_once 'core.php';

$assetID = $_POST['assetID'];

$sql = "SELECT	assetID,
				assetTagID,
				assetDescription,
				assetGeoTags,
				purchaseDate,
				purchaseFrom,
				cost,
				brand,
				model,
				serialNo
		FROM 	asset
		WHERE 	assetID = $assetID";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
	$row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);