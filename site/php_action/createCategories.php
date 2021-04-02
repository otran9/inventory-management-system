<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$categoriesName = $_POST['categoriesName'];
	$categoriesStatus = $_POST['categoriesStatus'];

	// Display the alert box 
	echo '<script>alert("Status: " + categoriesStatus);</script>';

	$sql = "INSERT INTO	categories (categories_name, 
									categories_active, 
									categories_status) 
			VALUES	(	'$categoriesName',  
						1,
						'$categoriesStatus')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the category";
	}

	$connect->close();

	echo json_encode($valid);
} // /if $_POST