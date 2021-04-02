<?php 	

require_once 'core.php';

$warrantyID = $_POST['warrantyID'];

$sql = "SELECT	warrantyID,
				length,
				expirDate,
				notes,
				assetID
		FROM	warranty
		WHERE	warrantyID = $warrantyID";
$result = $connect->query($sql);

if($result->num_rows > 0) {
	$row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);