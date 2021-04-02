<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<!--
includes/header.php - Add the new component to the navbar
warranty.php - The main page
custom/js/warranty.js - Scripting behavior. ADD TO THE BOTTOM

CREATE
php_action/createWarranty.php - Create a new record and add to the table in the database

READ
php_action/fetchWarranty.php - Fetch a record to display on the DataTable view

UPDATE
php_action/fetchSelectedWarranty.php - Fetch a specific record to edit
php_action/editWarranty.php - Change the values of a record's fields

DELETE
php_action/removeWarranty.php - Delete a record from its table by primary key
-->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading">Manage Warranties</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:5px;">
					<button class="btn-success btn-custom" data-toggle="modal" id="addWarrantyModalBtn" data-target="#addWarrantyModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Warranty </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageWarrantyTable">
					<thead>
						<tr class="dataTableTR">
							<th>Warranty ID</th>				
							<th>Length</th>
							<th>Expiration Date</th>							
							<th>Notes</th>
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

<!-- add warranty -->
<div class="modal fade" id="addWarrantyModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="submitWarrantyForm" action="php_action/createWarranty.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add Warranty</h4>
				</div>
				
				<div class="modal-body" style="overflow:auto;">
					<div id="add-warranty-messages"></div>

					<div class="form-group">
						<label for="length" class="col-sm-3 control-label">Length</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="length" placeholder="Length (in months)" name="length" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="expirDate" class="col-sm-3 control-label">Expiration Date<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="expirDate" name="expirDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="notes" class="col-sm-3 control-label">Notes</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="notes" placeholder="Text area for notes" name="notes" autocomplete="off" />
							</div>	
					  </div> <!--/form-group-->

					<div class="form-group">
						<label for="assetID" class="col-sm-3 control-label">Asset Tag ID<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="assetID" name="assetID">
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
				</div> <!-- /modal-body -->
				
				<div class="modal-footer">
					<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
					<button type="submit" class="btn-custom btn-success" id="createWarrantyBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Add Warranty</button>
				</div> <!-- /modal-footer -->	      
			</form> <!-- /.form -->	     
		</div> <!-- /modal-content -->    
	</div> <!-- /modal-dailog -->
</div> <!-- /modal fade -->
<!-- /add warranty -->

<!-- edit warranty -->
<div class="modal fade" id="editWarrantyModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="editWarrantyForm" action="php_action/editWarranty.php" method="POST">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Warranty</h4>
			</div>
			<div class="modal-body">

				<div id="edit-warranty-messages"></div>

				<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
					<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				</div>

				<div class="edit-warranty-result"> 

					<div class="form-group">
						<label for="editLength" class="col-sm-3 control-label">Length</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editLength" placeholder="Length (in months)" name="editLength" autocomplete="off">
							</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="editExpirDate" class="col-sm-3 control-label">Expiration Date<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editExpirDate" name="editExpirDate" autocomplete="off">
							</div>
					</div> <!-- /form-group-->
					
					<div class="form-group">
						<label for="editNotes" class="col-sm-3 control-label">Notes</label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="editNotes" placeholder="Text area for notes" name="editNotes" autocomplete="off" />
							</div>	
					  </div> <!--/form-group-->

					<div class="form-group">
						<label for="editAssetID" class="col-sm-3 control-label">Asset Tag ID<span class="requiredIcon">*</span></label>
						<label class="col-sm-1 control-label">:</label>
							<div class="col-sm-8">
								<select class="form-control" id="editAssetID" name="editAssetID">
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
				</div> <!-- /edit-warranty-result -->
			</div> <!-- /modal-body -->
			
			<div class="modal-footer editWarrantyFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			
				<button type="submit" class="btn-custom btn-success" id="editWarrantyBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			</div> <!-- /modal-footer -->
		</div> <!-- /modal-content -->
	</div> <!-- /modal-dailog -->
</div> <!-- /modal fade -->
<!-- /edit warranty -->

<!-- remove warranty -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeWarrantyModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Warranty</h4>
			</div>
			<div class="modal-body">
				<div class="removeWarrantyMessages"></div>
				<p>Do you really want to remove this warranty?</p>
			</div>
			<div class="modal-footer removeWarrantyFooter">
				<button type="button" class="btn-custom btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn-custom btn-danger" id="removeWarrantyBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Remove</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal fade -->
<!-- /remove warranty -->

<script src="custom/js/warranty.js"></script>

<?php require_once 'includes/footer.php'; ?>