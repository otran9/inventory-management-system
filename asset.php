<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<!--
asset.php
asset.js
createAsset.php
fetchAsset.php
fetchSelectedAsset.php
-->

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Asset</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Assets</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addAssetModalBtn" data-target="#addAssetModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Asset </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageAssetTable">
					<thead>
						<tr>
							<th>Asset Tag ID</th>							
							<th>Asset Description</th>
							<th>Asset Geo Tags</th>							
							<th>Purchase Date</th>
							<th>Purchase From</th>
							<th>Cost</th>
							<th>Brand</th>
							<th>Model</th>
							<th>Serial No.</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- add asset -->
<div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" id="submitAssetForm" action="php_action/createAsset.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Asset</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">
	      	<div id="add-asset-messages"></div>
			<!--
	      	<div class="form-group">
	        	<label for="assetImage" class="col-sm-3 control-label">Asset Image: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup - ->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="assetImage" placeholder="Asset Name" name="assetImage" class="file-loading" style="width:auto;"/>
					    </div>
				      
				    </div>
	        </div> <!-- /form-group- ->	     	           	       
			-->
	        <div class="form-group">
	        	<label for="assetTagID" class="col-sm-3 control-label">Asset Tag ID: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="assetTagID" placeholder="Asset Tag ID" name="assetTagID" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="assetDescription" class="col-sm-3 control-label">Asset Description: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="assetDescription" placeholder="Asset Description" name="assetDescription" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	        	 

	        <div class="form-group">
	        	<label for="assetGeoTags" class="col-sm-3 control-label">Asset Geo Tags: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="assetGeoTags" placeholder="Asset Geo Tags" name="assetGeoTags" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			
			<div class="form-group">
				<label for="purchaseDate" class="col-sm-3 control-label">Purchase Date</label>
				<label class="col-sm-1 control-label">: </label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="purchaseDate" name="purchaseDate" autocomplete="off" />
					</div>	
			  </div> <!--/form-group-->

	        <div class="form-group">
	        	<label for="purchaseFrom" class="col-sm-3 control-label">Purchase From: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="purchaseFrom" name="purchaseFrom" autocomplete="off" />
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="cost" class="col-sm-3 control-label">Cost: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="cost" placeholder="Cost" name="cost" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        

	        <div class="form-group">
	        	<label for="brand" class="col-sm-3 control-label">Brand: </label>
	        	<label class="col-sm-1 control-label">: </label>
					<!-- div for selecting brand from another table
					<div class="col-sm-8">
				      <input type="text" class="form-control" id="brand" placeholder="Brand" name="brand" autocomplete="off">
				    </div>
					-->
					<div class="col-sm-8">
				      <select class="form-control" id="brand" name="brand">
				      	<option value="">~~SELECT~~</option>
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
				    </div>
	        </div> <!-- /form-group-->	
			
	        <div class="form-group">
	        	<label for="model" class="col-sm-3 control-label">Model: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="model" placeholder="Model" name="model" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="serialNo" class="col-sm-3 control-label">Serial No.: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="serialNo" placeholder="Serial No." name="serialNo" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createAssetBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editAssetModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Asset</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs 
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
				    <li role="presentation"><a href="#assetInfo" aria-controls="profile" role="tab" data-toggle="tab">Asset Info</a></li>    
				  </ul>-->

				  <!-- Tab panes -->
				  <div class="tab-content">

				  	<!--
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/editAssetImage.php" method="POST" id="updateAssetImageForm" class="form-horizontal" enctype="multipart/form-data">

				    	<br />
				    	<div id="edit-assetPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editAssetImage" class="col-sm-3 control-label">Asset Image: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getAssetImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group- ->	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editAssetImage" class="col-sm-3 control-label">Select Photo: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    <!-- the avatar markup - ->
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editAssetImage" placeholder="Asset Name" name="editAssetImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div> <!-- /form-group- ->	     	           	       

			        <div class="modal-footer editAssetPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <!-- <button type="submit" class="btn btn-success" id="editAssetImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> - ->
				      </div>
				      <!-- /modal-footer - ->
				      </form>
				      <!-- /form - ->
				    </div>
				    <!-- asset image - ->
					-->
					
				    <div role="tabpanel" class="tab-pane" id="assetInfo">
				    	<form class="form-horizontal" id="editAssetForm" action="php_action/editAsset.php" method="POST">				    
				    	<br />

				    	<div id="edit-asset-messages"></div>

				    	<div class="form-group">
			        	<label for="editAssetName" class="col-sm-3 control-label">Asset Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAssetName" placeholder="Asset Name" name="editAssetName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	    

			        <div class="form-group">
			        	<label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	        	 

			        <div class="form-group">
			        	<label for="editRate" class="col-sm-3 control-label">Rate: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editRate" placeholder="Rate" name="editRate" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	     	        

			        <div class="form-group">
			        	<label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editBrandName" name="editBrandName">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	

			        <div class="form-group">
			        	<label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->					        	         	       

			        <div class="form-group">
			        	<label for="editAssetStatus" class="col-sm-3 control-label">Status: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editAssetStatus" name="editAssetStatus">
						      	<option value="">~~SELECT~~</option>
						      	<option value="1">Available</option>
						      	<option value="2">Not Available</option>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	         	        

			        <div class="modal-footer editAssetFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /asset info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAssetModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Asset</h4>
      </div>
      <div class="modal-body">

      	<div class="removeAssetMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeAssetFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeAssetBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/asset.js"></script>

<?php require_once 'includes/footer.php'; ?>