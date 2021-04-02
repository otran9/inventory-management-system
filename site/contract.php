<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<!--
includes/header.php - Add the new component to the navbar
contract.php - The main page
custom/js/contract.js - Scripting behavior. ADD TO THE BOTTOM

CREATE
php_action/createContract.php - Create a new record and add to the table in the database

READ
php_action/fetchContract.php - Fetch a record to display on the DataTable view

UPDATE
php_action/fetchSelectedContract.php - Fetch a specific record to edit
php_action/editContract.php - Change the values of a record's fields

DELETE
php_action/removeContract.php - Delete a record from its table by primary key
-->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading">Manage Contracts</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:5px;">
					<button class="btn-success btn-custom" data-toggle="modal" id="addContractModalBtn" data-target="#addContractModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Contract </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageContractTable">
					<thead>
						<tr class="dataTableTR">
							<th>Title</th>				
							<th>Desc.</th>
							<th>Start Date</th>							
							<th>End Date</th>
							<th>Number</th>
							<th>Cost</th>
							<th>Vendor</th>
							<th>Person</th>
							<th>Phone</th>
							<th>Licenses</th>
							<th>Software</th>
							<th>Tag ID</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- add contract -->
<div class="modal fade" id="addContractModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="submitContractForm" action="php_action/createContract.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Contract</h4>
				</div>
				
				<div class="modal-body" style="overflow:auto;">
				<!--<div class="modal-body" style="max-height:600px; overflow:auto;">-->
					<div id="add-contract-messages"></div>
					
					<div class="form-group">
						<label for="contractTitle" class="col-sm-3 control-label">Title<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="contractTitle" placeholder="Title" name="contractTitle" autocomplete="off">
							</div>
					</div> <!-- /form-group-->	    

					<div class="form-group">
						<label for="description" class="col-sm-3 control-label">Description</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="description" placeholder="Description" name="description" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="startDate" class="col-sm-3 control-label">Start Date<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="startDate" name="startDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="endDate" class="col-sm-3 control-label">End Date<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="endDate" name="endDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="contractNo" class="col-sm-3 control-label">Contract Number</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="contractNo" name="contractNo" autocomplete="off" />
							</div>	
					  </div> <!--/form-group-->

					<div class="form-group">
						<label for="cost" class="col-sm-3 control-label">Cost</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="cost" name="cost" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="vendor" class="col-sm-3 control-label">Vendor</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="vendor" name="vendor" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="contractPerson" class="col-sm-3 control-label">Contract Person</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="contractPerson" name="contractPerson" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="phone" class="col-sm-3 control-label">Contract Person Phone</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="phone" name="phone" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="noOfLicenses" class="col-sm-3 control-label">Number of Licenses</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="noOfLicenses" name="noOfLicenses" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="isSoftware" class="col-sm-3 control-label">Is Software?</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="isSoftware" name="isSoftware">
									<option value="">~~SELECT~~</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
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
					<button type="submit" class="btn-custom btn-success" id="createContractBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Add Contract</button>
				</div> <!-- /modal-footer -->	      
			</form> <!-- /.form -->	     
		</div> <!-- /modal-content -->    
	</div> <!-- /modal-dailog -->
</div> <!-- /modal fade -->
<!-- /add contract -->

<!-- edit contract -->
<div class="modal fade" id="editContractModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="editContractForm" action="php_action/editContract.php" method="POST">
			<!---->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Contract</h4>
			</div>
			<div class="modal-body">

				<div id="edit-contract-messages"></div>

				<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
					<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				</div>

				<div class="edit-contract-result">
				
					<div class="form-group">
						<label for="editContractTitle" class="col-sm-3 control-label">Title<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editContractTitle" placeholder="Title" name="editContractTitle" autocomplete="off">
							</div>
					</div> <!-- /form-group-->	    

					<div class="form-group">
						<label for="editDescription" class="col-sm-3 control-label">Description</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editDescription" placeholder="Description" name="editDescription" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editStartDate" class="col-sm-3 control-label">Start Date<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editStartDate" name="editStartDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editEndDate" class="col-sm-3 control-label">End Date<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editEndDate" name="editEndDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="editContractNo" class="col-sm-3 control-label">Contract Number</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editContractNo" name="editContractNo" autocomplete="off" />
							</div>	
					  </div> <!--/form-group-->

					<div class="form-group">
						<label for="editCost" class="col-sm-3 control-label">Cost</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editCost" name="editCost" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editVendor" class="col-sm-3 control-label">Vendor</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editVendor" name="editVendor" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editContractPerson" class="col-sm-3 control-label">Contract Person</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editContractPerson" name="editContractPerson" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editPhone" class="col-sm-3 control-label">Contract Person Phone</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editPhone" name="editPhone" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editNoOfLicenses" class="col-sm-3 control-label">Number of Licenses</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editNoOfLicenses" name="editNoOfLicenses" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="editIsSoftware" class="col-sm-3 control-label">Is Software?</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="editIsSoftware" name="editIsSoftware">
									<option value="">~~SELECT~~</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editAssetTagID" class="col-sm-3 control-label">Asset Tag ID<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="editAssetTagID" name="editAssetTagID">
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
							</div>
					</div> <!-- /form-group-->
					
				</div> <!-- /edit-contract-result -->
				
			</div> <!-- /modal-body -->
			
			<div class="modal-footer editContractFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			
				<button type="submit" class="btn-custom btn-success" id="editContractBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			</div> <!-- /modal-footer -->
		</div> <!-- /modal-content -->
	</div> <!-- /modal-dailog -->
</div> <!-- /modal fade -->
<!-- /edit contract -->

<!-- remove contract -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeContractModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Contract</h4>
			</div>
			<div class="modal-body">
				<div class="removeContractMessages"></div>
				<p>Do you really want to remove this contract?</p>
			</div>
			<div class="modal-footer removeContractFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn-custom btn-danger" id="removeContractBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Remove</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->
<!-- /remove contract -->

<script src="custom/js/contract.js"></script>

<?php require_once 'includes/footer.php'; ?>