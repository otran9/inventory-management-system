<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['a'] == 'addAsset') { 
// add asset
	echo "<div class='div-request div-hide'>addAsset</div>";
} else if($_GET['a'] == 'manageAsset') { 
	echo "<div class='div-request div-hide'>manageAsset</div>";
} else if($_GET['a'] == 'editAsset') { 
	echo "<div class='div-request div-hide'>editAsset</div>";
} // /else manage asset
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php if($_GET['a'] == 'addAsset') { ?>
  			Add Asset
		<?php } else if($_GET['a'] == 'manageAsset') { ?>
			<div class="page-heading"> Manage Assets</div>
		<?php } else if($_GET['a'] == 'editAsset') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Asset
		<?php } ?>
	</div> <!--/panel-heading -->

	<div class="panel-body">
		<?php if ($_GET['a'] == 'addAsset') { 
		// add asset
		?>
			<div class="success-messages"></div> <!--/success-messages-->

  			<form class="form-horizontal" method="POST" action="php_action/createAsset2.php" id="createAssetForm">
				<!-- TIC: ASSET FORM GROUPS -->
				<div class="col-md-12">
	  				<div class="form-group">
						<label for="assetTagID" class="col-sm-2 control-label">Tag ID<span class="requiredIcon">*</span>:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="assetTagID" placeholder="Tag ID" name="assetTagID" autocomplete="off" />
						</div>
					</div> <!--/form-group-->

	  				<div class="form-group">
						<label for="assetDescription" class="col-sm-2 control-label">Description<span class="requiredIcon">*</span>:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="assetDescription" placeholder="Description" name="assetDescription" autocomplete="off" />
							<!--
							<input type="text" class="form-control" id="assetDescription" name="assetDescription" autocomplete="off" />
							-->
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-12 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="purchaseDate" class="col-sm-4 control-label">Purchase Date:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="purchaseDate" placeholder="YYYY-MM-DD" name="purchaseDate" autocomplete="off" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="purchaseFrom" class="col-sm-4 control-label">Purchase From:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="purchaseFrom" name="purchaseFrom" autocomplete="off" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="categories_id" class="col-sm-4 control-label">Category:</label>
						<div class="col-sm-6">
							<select class="form-control" id="categories_id" name="categories_id">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	categories_id, 
													categories_name, 
													categories_active, 
													categories_status 
											FROM 	categories 
											WHERE 	categories_id != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
								?>
							</select>
						</div>
						<!-- 
						Add button to add new category through modal.
						id="add*ModalBtn" leads to the .js.
						data-target="#add*Modal" leads to the modal view at the bottom.
						 -->
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="brand" class="col-sm-4 control-label">Brand:</label>
						<div class="col-sm-6">
							<select class="form-control" id="brand" name="brand">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	brand_id, 
													brand_name, 
													brand_active, 
													brand_status 
											FROM 	brands 
											WHERE 	brand_id != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
								?>
							</select>
							<!--<input type="text" class="form-control" id="brand" placeholder="Brand" name="brand" autocomplete="off" />-->
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addBrandModalBtn" data-target="#addBrandModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="model" class="col-sm-4 control-label">Model:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="model" placeholder="Model" name="model" autocomplete="off" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="serialNo" class="col-sm-4 control-label">Serial #:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="serialNo" placeholder="Serial Number" name="serialNo" autocomplete="off" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-4 -->

				<div class="col-md-12">
					<div class="form-group">
						<label for="cost" class="col-sm-2 control-label">Cost:</label>
						<div class="col-sm-3">
							<input type="number" min="0" class="form-control" id="cost" placeholder="Cost" name="cost" autocomplete="off" />
						</div>
					</div> <!--/form-group-->

					<div class="form-group">
						<label for="user_id" class="col-sm-2 control-label">User:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="user_id" placeholder="User ID" name="user_id" autocomplete="off" />
						</div>
					</div> <!--/form-group-->

					<div class="form-group">
						<label for="departmentID" class="col-sm-2 control-label">Department:</label>
						<div class="col-sm-3">
							<select class="form-control" id="departmentID" name="departmentID">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	departmentID,  
													departmentName 
											FROM 	department 
											WHERE 	departmentID != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
								?>
							</select>
							<!--<input type="text" class="form-control" id="departmentID" name="departmentID" autocomplete="off" />-->
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addDepartmentModalBtn" data-target="#addDepartmentModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-12 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="siteID" class="col-sm-4 control-label">Site:</label>
						<div class="col-sm-6">
							<select class="form-control" id="siteID" name="siteID">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	siteID,  
													siteName 
											FROM 	site 
											WHERE 	siteID != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
								?>
							</select>
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addSiteModalBtn" data-target="#addSiteModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-4 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="locationID" class="col-sm-4 control-label">Location:</label>
						<div class="col-sm-6">
							<select class="form-control" id="locationID" name="locationID">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	locationID,  
													location 
											FROM 	location 
											WHERE 	locationID != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
								?>
							</select>
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-4 -->
				<!-- /TIC: ASSET FORM GROUPS -->

				<div class="form-group submitButtonFooter">
				    <div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn-custom btn-default" onclick="location.href='asset2.php?a=manageAsset'" id="navAsset" data-loading-text="Loading..."><i class="glyphicon glyphicon-circle-arrow-left"></i> Back</button>

						<button type="submit" id="createAssetBtn" data-loading-text="Loading..." class="btn-custom btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Asset</button>

						<button type="reset" class="btn-custom btn-default" onclick="resetAssetForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
				    </div>
				</div>
			</form>

		<?php } else if($_GET['a'] == 'manageAsset') { 
		// manage asset
		?>
			<div id="success-messages"></div>

			<div class="div-action pull pull-right" id="topNavAddAsset" style="padding-bottom:5px;">
				<a href="asset2.php?a=addAsset">
					<button class="btn-custom btn-success" id="addAssetBtn" data-target="#addAsset">
						<i class="glyphicon glyphicon-plus-sign"></i> Add Asset 
					</button>
				</a>
			</div> <!-- /div-action -->	
			
			<table class="table" id="manageAssetTable">
				<thead>
					<!-- fetchAsset2.php -->
					<tr class="dataTableTR">
						<th>Tag ID</th>
						<th>Description</th>
						<th>Geo Tags</th> 
						<th>Purchase Date</th>
						<th>Purchase From</th>
						<th>Category</th>
						<th>Cost</th>
						<th>Brand</th>
						<th>Model</th>
						<th>Serial#</th>
						<th>Status</th>
						<th>Option</th>
					</tr>
					<!--
					-->
				</thead>
			</table>

		<?php 
		// /else manage asset
		} else if($_GET['a'] == 'editAsset') {
		// get asset
		?>
			<div class="success-messages"></div> <!--/success-messages-->

  			<form class="form-horizontal" method="POST" action="php_action/editAsset2.php" id="editAssetForm">

  				<?php $assetID = $_GET['i'];

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
	  							asset.asset_image, 
	  							asset.user_id, 
	  							asset.status, 
	  							asset.activeDate, 
	  							asset.contractID, 
	  							asset.warrantyID, 
	  							asset.departmentID, 
	  							asset.siteID, 
	  							asset.locationID
	  					FROM 	asset 	
						WHERE 	asset.assetID = {$assetID}";

					$result = $connect->query($sql);
					$data = $result->fetch_row();
	  			?>

	  			<!--
				0	asset.assetID, 
				1	asset.assetTagID, 
				2	asset.assetDescription, 
				3	asset.assetGeoTags, 
				4	asset.purchaseDate, 
				5	asset.purchaseFrom, 
				6	asset.cost, 
				7	asset.categories_id, 
				8	asset.brand, 
				9	asset.model, 
				10	asset.serialNo, 
				11	asset.asset_image, 
				12	asset.user_id, 
				13	asset.status, 
				14	asset.activeDate, 
				15	asset.contractID, 
				16	asset.warrantyID, 
				17	asset.departmentID, 
				18	asset.siteID, 
				19	asset.locationID
	  			-->
				<!-- TIC: EDIT ASSET FORM GROUPS -->
				<div class="col-md-12">
	  				<div class="form-group">
						<label for="assetTagID" class="col-sm-2 control-label">Tag ID<span class="requiredIcon">*</span>:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="assetTagID" name="assetTagID" autocomplete="off" value="<?php echo $data[1] ?>" />
						</div>
					</div> <!--/form-group-->

	  				<div class="form-group">
						<label for="assetDescription" class="col-sm-2 control-label">Description<span class="requiredIcon">*</span>:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="assetDescription" name="assetDescription" autocomplete="off" value="<?php echo $data[2] ?>" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-12 -->

				<input type="hidden" class="form-control" id="status" name="status" value="<?php echo $data[13] ?>"/>

				<div class="col-md-6">
					<div class="form-group">
						<label for="status" class="col-sm-4 control-label">Status:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="status" name="status" disabled="true" autocomplete="off" value="<?php echo $data[13] ?>" />
							<input type="hidden" class="form-control" id="statusValue" name="statusValue" value="<?php echo $data[13] ?>" />
							<!---->
							<!--<input type="text" class="form-control" id="assetGeoTags" name="assetGeoTags" autocomplete="off" value="<?php echo $data[3] ?>" />-->
						</div>
					</div> <!--/form-group-->
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="assetGeoTags" class="col-sm-4 control-label">Geo Tags:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="assetGeoTags" name="assetGeoTags" disabled="true" autocomplete="off" value="<?php echo $data[3] ?>" />
							<input type="hidden" class="form-control" id="assetGeoTagsValue" name="assetGeoTagsValue" value="<?php echo $data[3] ?>" />
							<!---->
							<!--<input type="text" class="form-control" id="assetGeoTags" name="assetGeoTags" autocomplete="off" value="<?php echo $data[3] ?>" />-->
						</div>
					</div> <!--/form-group-->
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label for="user_id" class="col-sm-2 control-label">User:</label>
						<div class="col-sm-3">
							<select class="form-control" id="user_id" name="user_id">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	user_id, 
													username 
											FROM 	users
											WHERE 	user_id != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										if ($data[12] == $row[0]) {
											echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while
								?>
							</select>
						</div>
					</div> <!--/form-group-->
				</div>

				<div class="col-md-12"><hr><br></div> <!-- horizontal line -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="purchaseDate" class="col-sm-4 control-label">Purchase Date:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="purchaseDate" name="purchaseDate" autocomplete="off" value="<?php echo $data[4] ?>" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="purchaseFrom" class="col-sm-4 control-label">Purchase From:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="purchaseFrom" name="purchaseFrom" autocomplete="off" value="<?php echo $data[5] ?>" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="categories_id" class="col-sm-4 control-label">Category:</label>
						<div class="col-sm-6">
							<select class="form-control" id="categories_id" name="categories_id">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	categories_id, 
													categories_name, 
													categories_active, 
													categories_status 
											FROM 	categories 
											WHERE 	categories_id != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										// TIC: USE THIS IF STATEMENT IN THIS WHILE LOOP TO SET THE VALUE FOR THE SELECT DROPDOWN
										if ($data[7] == $row[0]) {
											echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while

									/*
									*/
								?>
							</select>
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="brand" class="col-sm-4 control-label">Brand:</label>
						<div class="col-sm-6">
							<select class="form-control" id="brand" name="brand">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	brand_id, 
													brand_name, 
													brand_active, 
													brand_status 
											FROM 	brands 
											WHERE 	brand_id != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										if ($data[8] == $row[0]) {
											echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while
								?>
							</select>
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addBrandModalBtn" data-target="#addBrandModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="model" class="col-sm-4 control-label">Model:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="model" name="model" autocomplete="off" value="<?php echo $data[9] ?>" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="serialNo" class="col-sm-4 control-label">Serial #:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id="serialNo" name="serialNo" autocomplete="off" value="<?php echo $data[10] ?>" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-4 -->

				<div class="col-md-12">
					<div class="form-group">
						<label for="cost" class="col-sm-2 control-label">Cost:</label>
						<div class="col-sm-3">
							<input type="number" min="0" class="form-control" id="cost" name="cost" autocomplete="off" value="<?php echo $data[6] ?>" />
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-12 -->
				
				<div class="col-md-12"><hr><br></div> <!-- horizontal line -->

				<div class="col-md-12">
					<div class="form-group">
						<label for="departmentID" class="col-sm-2 control-label">Department:</label>
						<div class="col-sm-3">
							<select class="form-control" id="departmentID" name="departmentID">
								<option value="">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	departmentID,  
													departmentName 
											FROM 	department 
											WHERE 	departmentID != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										if ($data[17] == $row[0]) {
											echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while
								?>
							</select>
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addDepartmentModalBtn" data-target="#addDepartmentModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-12 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="siteID" class="col-sm-4 control-label">Site:</label>
						<div class="col-sm-6">
							<select class="form-control" id="siteID" name="siteID">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	siteID,  
													siteName 
											FROM 	site 
											WHERE 	siteID != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										if ($data[18] == $row[0]) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while
								?>
							</select>
						</div>
						<button type="button" class="btn btn-success btn-circle" data-toggle="modal" id="addSiteModalBtn" data-target="#addSiteModal">
							<i class="glyphicon glyphicon-plus-sign"></i>
						</button>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->

				<div class="col-md-6">
					<div class="form-group">
						<label for="locationID" class="col-sm-4 control-label">Location:</label>
						<div class="col-sm-6">
							<select class="form-control" id="locationID" name="locationID">
								<option value="0">~~SELECT~~</option>
								<?php 
									$sql = "SELECT	locationID,  
													location 
											FROM 	location 
											WHERE 	locationID != 0";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										if ($data[19] == $row[0]) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while
								?>
							</select>
						</div>
					</div> <!--/form-group-->
				</div> <!-- /col-md-6 -->
				<!-- /TIC: ASSET FORM GROUPS -->

				<!--
				<div class="col-sm-12">
					<br>
				</div>

				<div class="form-group functionButtonFooter">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn-custom btn-warning" data-toggle="modal" data-target="#checkOutAssetModal" id="checkOutAssetModalBtn" onclick="checkOutAsset('<?php echo $data[0] ?>')" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Check Out</button>
						
						<button type="button" class="btn-custom btn-warning" id="checkOutAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Check Out</button>
						

						<button type="button" class="btn-custom btn-primary" id="scanAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-barcode"></i> Scan</button>
					</div>
				</div>
				-->

				<div class="col-md-12">
					<br>
				</div>

				<div class="form-group editButtonFooter">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn-custom btn-default" onclick="location.href='asset2.php?a=manageAsset'" id="navAsset" data-loading-text="Loading..."><i class="glyphicon glyphicon-circle-arrow-left"></i> Back</button>
						
						<input type="hidden" name="assetID" id="assetID" value="<?php echo $_GET['i']; ?>" />
						
						<button type="submit" id="editAssetBtn" data-loading-text="Loading..." class="btn-custom btn-success"><i class="glyphicon glyphicon-edit"></i> Save Changes</button>
					</div>
				</div>
			</form> <!-- /editAssetForm -->

		<?php
		} // /get asset else  ?>

	</div> <!--/panel-->	
</div> <!--/panel-->	

<!-- add categories modal -->
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createCategories.php" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title"><i class="fa fa-plus"></i> Add Category</h4>
				</div> <!-- /modal-header -->

				<div class="modal-body">
					<div id="add-categories-messages"></div>

					<div class="form-group">
			        	<label for="categoriesName" class="col-sm-4 control-label">Category Name<span class="requiredIcon">*</span>:</label>
						<div class="col-sm-6">
				    		<input type="text" class="form-control" id="categoriesName" placeholder="Category Name" name="categoriesName" autocomplete="off">
						</div>
	        		</div> <!-- /form-group-->

	        		<!-- Have to add active here FOR createCategories.php to get. Make hidden -->
				</div> <!-- /modal-body -->

				<div class="modal-footer">
			        <button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			        
			        <button type="submit" class="btn-custom btn-success" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Add Category</button>
	      		</div> <!-- /modal-footer -->
			</form> <!-- /form-horizontal -->
		</div> <!-- /modal-content -->
	</div> <!-- /modal-dialog -->
</div> <!-- /add categories modal -->
<!-- / -->

<!-- check out asset -->
<div class="modal fade" tabindex="-1" role="dialog" id="checkOutAssetModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<!--<form class="form-horizontal" id="checkOutAssetForm" method="POST" action="php_action/checkOutAsset.php">-->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="glyphicon glyphicon-ok-sign"></i> Check Out Asset</h4>
				</div>

				<div class="modal-body">
					<div class="checkOutAssetMessages"></div>
					<p>Are you sure you want to check out this asset?</p>
				</div>

				<div class="modal-footer checkOutAssetFooter">
					<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

					<button type="button" class="btn-custom btn-warning" id="checkOutAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Check Out</button>
					<!--
					<button type="button" class="btn-custom btn-warning" id="checkOutAssetBtn" onclick="checkOutAsset('$data[0]')" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Check Out</button>
					-->
				</div>
			<!--</form>-->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /check out asset-->

<!-- scan asset -->
<div class="modal fade" tabindex="-1" role="dialog" id="scanAssetModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-ok-sign"></i> Scan Asset</h4>
			</div>
			<div class="modal-body">
				<div class="scanAssetMessages"></div>
			<p>Are you sure you want to scan this asset?</p>
			</div>
			<div class="modal-footer scanAssetFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn-custom btn-primary" id="scanAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Scan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /check out asset-->

<!-- remove asset -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAssetModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Asset</h4>
			</div>
			<div class="modal-body">
				<div class="removeAssetMessages"></div>
			<p>Do you really want to remove this asset?</p>
			</div>
			<div class="modal-footer removeAssetFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn-custom btn-danger" id="removeAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Remove</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove asset-->

<script src="custom/js/asset2.js"></script>

<?php require_once 'includes/footer.php'; ?>