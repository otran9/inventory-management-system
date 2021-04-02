<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<!--
includes/header.php - Add the new component to the navbar
maint.php - The main page
custom/js/maint.js - Scripting behavior. ADD TO THE BOTTOM

CREATE
php_action/createMaint.php - Create a new record and add to the table in the database

READ
php_action/fetchMaint.php - Fetch a record to display on the DataTable view

UPDATE
php_action/fetchSelectedMaint.php - Fetch a specific record to edit
php_action/editMaint.php - Change the values of a record's fields

DELETE
php_action/removeMaint.php - Delete a record from its table by primary key
-->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading">Manage Maintenance</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:5px;">
					<button class="btn-success btn-custom" data-toggle="modal" id="addMaintModalBtn" data-target="#addMaintModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Maintenance </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageMaintTable">
					<thead>
						<tr class="dataTableTR">
							<th>Title</th>							
							<th>Details</th>
							<th>Due Date</th>							
							<th>Maintenance By</th>
							<th>Maintenance Status</th>
							<th>Date Completed</th>
							<th>Repair Cost</th>
							<th>Repeating</th>
							<th>Asset Tag ID</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- add maint -->
<div class="modal fade" id="addMaintModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="submitMaintForm" action="php_action/createMaint.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Maintenance</h4>
				</div>
				
				<div class="modal-body" style="overflow:auto;">
				<!--<div class="modal-body" style="max-height:600px; overflow:auto;">-->
					<div id="add-maint-messages"></div>
					
					<div class="form-group">
						<label for="title" class="col-sm-3 control-label">Title<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="title" placeholder="Title" name="title" autocomplete="off">
							</div>
					</div> <!-- /form-group-->	    

					<div class="form-group">
						<label for="details" class="col-sm-3 control-label">Details<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="details" placeholder="Details" name="details" autocomplete="off">
							</div>
					</div> <!-- /form-group-->	        	 

					<div class="form-group">
						<label for="dueDate" class="col-sm-3 control-label">Due Date</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="dueDate" name="dueDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="maintBy" class="col-sm-3 control-label">Maintenance By</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="maintBy" name="maintBy" autocomplete="off" />
							</div>	
					  </div> <!--/form-group-->

					<div class="form-group">
						<label for="maintStatus	" class="col-sm-3 control-label">Maintenance Status</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <select class="form-control" id="maintStatus" name="maintStatus">
									<option value="">~~SELECT~~</option>
									<option value="Scheduled">Scheduled</option>
									<option value="In Progress">In Progress</option>
									<option value="On Hold">On Hold</option>
									<option value="Cancelled">Cancelled</option>
									<option value="Completed">Completed</option>
								</select>
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="dateCompleted" class="col-sm-3 control-label">Date Completed</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="dateCompleted" name="dateCompleted" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="repairsCost" class="col-sm-3 control-label">Cost of Repairs</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="repairsCost" name="repairsCost" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="repeating" class="col-sm-3 control-label">Repeating</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="repeating" name="repeating">
									<option value="">~~SELECT~~</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
									<?php 
									/*
									$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
											$result = $connect->query($sql);

											while($row = $result->fetch_array()) {
												echo "<option value='".$row[0]."'>".$row[1]."</option>";
											} // while
									*/		
									?>
								</select>
								<!--
								<input type="text" class="form-control" id="model" name="model" autocomplete="off">-->
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="assetTagID" class="col-sm-3 control-label">Asset Tag ID<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="assetTagID" name="assetTagID">
									<option value="">~~SELECT~~</option>
									<?php
										$sql = "SELECT	assetID, assetTagID
												FROM	asset";
										$result = $connect->query($sql);
										
										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									?>
								</select>
								<!--
								<input type="text" class="form-control" id="assetTagID" placeholder="Asset Tag ID" name="assetTagID" autocomplete="off">-->
							</div>
					</div> <!-- /form-group-->
				</div> <!-- /modal-body -->
				
				<div class="modal-footer">
					<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
					<button type="submit" class="btn-custom btn-success" id="createMaintBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Add Maintenance</button>
				</div> <!-- /modal-footer -->	      
			</form> <!-- /.form -->	     
		</div> <!-- /modal-content -->    
	</div> <!-- /modal-dailog -->
</div> <!-- /modal fade -->
<!-- /add maint -->

<!-- edit maint -->
<div class="modal fade" id="editMaintModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="editMaintForm" action="php_action/editMaint.php" method="POST">
			<!---->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Maintenance</h4>
			</div>
			<div class="modal-body">

				<div id="edit-maint-messages"></div>

				<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
					<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				</div>

				<div class="edit-maint-result">
				
					<div class="form-group">
						<label for="editTitle" class="col-sm-3 control-label">Title<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editTitle" placeholder="Title" name="editTitle" autocomplete="off">
							</div>
					</div> <!-- /form-group-->	    

					<div class="form-group">
						<label for="editDetails" class="col-sm-3 control-label">Details<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editDetails" placeholder="Details" name="editDetails" autocomplete="off">
							</div>
					</div> <!-- /form-group-->	        	 

					<div class="form-group">
						<label for="editDueDate" class="col-sm-3 control-label">Due Date</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editDueDate" name="editDueDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="editMaintBy" class="col-sm-3 control-label">Maintenance By</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editMaintBy" name="editMaintBy" autocomplete="off" />
							</div>	
					  </div> <!--/form-group-->

					<div class="form-group">
						<label for="editMaintStatus	" class="col-sm-3 control-label">Maintenance Status</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <select class="form-control" id="editMaintStatus" name="editMaintStatus">
									<option value="">~~SELECT~~</option>
									<option value="Scheduled">Scheduled</option>
									<option value="In Progress">In Progress</option>
									<option value="On Hold">On Hold</option>
									<option value="Cancelled">Cancelled</option>
									<option value="Completed">Completed</option>
								</select>
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editDateCompleted" class="col-sm-3 control-label">Date Completed</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editDateCompleted" name="editDateCompleted" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editRepairsCost" class="col-sm-3 control-label">Cost of Repairs</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editRepairsCost" name="editRepairsCost" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="editRepeating" class="col-sm-3 control-label">Repeating</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="editRepeating" name="editRepeating">
									<option value="">~~SELECT~~</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
									<?php 
									/*
									$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
											$result = $connect->query($sql);

											while($row = $result->fetch_array()) {
												echo "<option value='".$row[0]."'>".$row[1]."</option>";
											} // while
									*/		
									?>
								</select>
								<!--
								<input type="text" class="form-control" id="model" name="model" autocomplete="off">-->
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editAssetTagID" class="col-sm-3 control-label">Asset Tag ID<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="editAssetTagID" name="editAssetTagID">
									<option value="">~~SELECT~~</option>
									<?php
										$sql = "SELECT	assetID, 
														assetTagID
												FROM	asset";
										$result = $connect->query($sql);
										
										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									?>
								</select>
							</div>
					</div> <!-- /form-group-->
					
				</div> <!-- /edit-maint-result -->
				
			</div> <!-- /modal-body -->
			
			<div class="modal-footer editMaintFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			
				<button type="submit" class="btn-custom btn-success" id="editMaintBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			</div> <!-- /modal-footer -->
		</div> <!-- /modal-content -->
	</div> <!-- /modal-dailog -->
</div> <!-- /modal fade -->
<!-- /edit maint -->

<!-- remove maint -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMaintModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Maintenance</h4>
			</div>
			<div class="modal-body">
				<div class="removeMaintMessages"></div>
				<p>Do you really want to remove this maintenance?</p>
			</div>
			<div class="modal-footer removeMaintFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn-custom btn-danger" id="removeMaintBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Remove</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->
<!-- /remove maint -->

<script src="custom/js/maint.js"></script>

<?php require_once 'includes/footer.php'; ?>