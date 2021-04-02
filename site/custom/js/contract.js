var manageContractTable;

$(document).ready(function() {
	// top nav bar 
	$('#navContract').addClass('active');
	// manage contract data table
	manageContractTable = $('#manageContractTable').DataTable({
		'ajax': 'php_action/fetchContract.php',
		'order': []
	});

	// add contract modal btn clicked
	$("#addContractModalBtn").unbind('click').bind('click', function() {
		// // contract form reset
		$("#submitContractForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		
		// due date picker
		$("#startDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		// date completed picker
		$("#endDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
				
		// submit contract form
		$("#submitContractForm").unbind('submit').bind('submit', function() {
			// form validation
			var contractTitle = $("#contractTitle").val();
			var description = $("#description").val();
			var startDate = $("#startDate").val();
			var endDate = $("#endDate").val();
			var contractNo = $("#contractNo").val();
			var cost = $("#cost").val();
			var vendor = $("#vendor").val();
			var contractPerson = $("#contractPerson").val();
			var phone = $("#phone").val();
			var noOfLicenses = $("#noOfLicenses").val();
			var isSoftware = $("#isSoftware").val();
			var assetTagID = $("#assetTagID").val();

			if(contractTitle == "") {
				$("#contractTitle").after('<p class="text-danger">Contract Title is required</p>');
				$('#contractTitle').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#contractTitle").find('.text-danger').remove();
				// success out for form 
				$("#contractTitle").closest('.form-group').addClass('has-success');
			}	// /else

			if(startDate == "") {
				$("#startDate").after('<p class="text-danger">Start Date is required</p>');
				$('#startDate').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#startDate").find('.text-danger').remove();
				// success out for form 
				$("#startDate").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(endDate == "") {
				$("#endDate").after('<p class="text-danger">End Date is required</p>');
				$('#endDate').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#endDate").find('.text-danger').remove();
				// success out for form 
				$("#endDate").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(assetTagID == "") {
				$("#assetTagID").after('<p class="text-danger">Asset Tag ID is required</p>');
				$('#assetTagID').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#assetTagID").find('.text-danger').remove();
				// success out for form 
				$("#assetTagID").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(contractTitle && startDate && endDate && assetTagID) {
				// submit loading button
				$("#createContractBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);
				
				var getData; // OTRAN
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {
						console.log(response);
						//alert("response.success = " + response.success); // OTRAN
						
						if(response.success == true) {
							// submit loading button
							$("#createContractBtn").button('reset');
							
							//NTRAN 
							//alert("BEFORE submitContractForm reset");
							
							$("#submitContractForm")[0].reset();

							//NTRAN 
							//alert("AFTER submitContractForm reset");

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-contract-messages').html('<div class="alert alert-success">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							'</div>');

							// remove the mesages
							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$('#addContractModal').modal('hide');
									//$(this).remove();
								});
							}); // /.alert

							// reload the manage contract table
							manageContractTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');
						} // /if response.success
					} // /success function
				}); // /ajax function
			} // /if validation is ok
			
			return false;
		}); // /submit contract form
	}); // /add contract modal btn clicked
}); // document.ready function

function editContract(contractID = null) {
	if(contractID) {
		//alert("ENTERING function editContract | contractID: " + contractNumber); //OTRAN

		$("#contractID").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');
		
		// due date picker
		$("#editStartDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		// date completed picker
		$("#editEndDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		
		$.ajax({
			url: 'php_action/fetchSelectedContract.php',
			type: 'post',
			data: {contractID: contractID},
			dataType: 'json',
			success:function(response) {			
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// contract number 
				$(".editContractFooter").append('<input type="hidden" name="contractID" id="contractID" value="'+response.contractID+'" />');				
				
				$("#editContractTitle").val(response.contractTitle);
				$("#editDescription").val(response.description);
				$("#editStartDate").val(response.startDate);
				$("#editEndDate").val(response.endDate);
				$("#editContractNo").val(response.contractNo);
				$("#editCost").val(response.cost);
				$("#editVendor").val(response.vendor);
				$("#editContractPerson").val(response.contractPerson);
				$("#editPhone").val(response.phone);
				$("#editNoOfLicenses").val(response.noOfLicenses);
				$("#editIsSoftware").val(response.isSoftware);
				$("#editAssetTagID").val(response.assetID);

				// update the contract data function
				$("#editContractForm").unbind('submit').bind('submit', function() {
					var contractTitle = $("#editContractTitle").val();
					var description = $("#editDescription").val();
					var startDate = $("#editStartDate").val();
					var endDate = $("#editEndDate").val();
					var contractNo = $("#editContractNo").val();
					var cost = $("#editCost").val();
					var vendor = $("#editVendor").val();
					var contractPerson = $("#editContractPerson").val();
					var phone = $("#editPhone").val();
					var noOfLicenses = $("#editNoOfLicenses").val();
					var isSoftware = $("#editIsSoftware").val();
					var assetTagID = $("#editAssetTagID").val();

					if(contractTitle == "") {
						$("#editContractTitle").after('<p class="text-danger">Title is required</p>');
						$('#editContractTitle').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editContractTitle").find('.text-danger').remove();
						// success out for form 
						$("#editContractTitle").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(startDate == "") {
						$("#editStartDate").after('<p class="text-danger">Start Date is required</p>');
						$('#editStartDate').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editStartDate").find('.text-danger').remove();
						// success out for form 
						$("#editStartDate").closest('.form-group').addClass('has-success');	  	
					} // /else

					if(endDate == "") {
						$("#editEndDate").after('<p class="text-danger">End Date is required</p>');
						$('#editEndDate').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editEndDate").find('.text-danger').remove();
						// success out for form 
						$("#editEndDate").closest('.form-group').addClass('has-success');
					} // /else

					if(assetTagID == "") {
						$("#editAssetTagID").after('<p class="text-danger">Asset Tag ID is required</p>');
						$('#editAssetTagID').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAssetTagID").find('.text-danger').remove();
						// success out for form 
						$("#editAssetTagID").closest('.form-group').addClass('has-success');
					} // /else

					if(contractTitle && startDate && endDate && assetTagID) {
						//alert("Contract Title: " + contractTitle);
						// submit loading button
						$("#editContractBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								//console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editContractBtn").button('reset');
									
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-contract-messages').html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									'</div>');

									// remove the mesages
									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$('#editContractModal').modal('hide');
											//$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageContractTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');
								} // /if response.success
							} // /success function
						}); // /ajax function
					} // if validation is ok
					
					return false;
				}); // update the contract data function

			} // /success function
		}); // /ajax to fetch contract image
	} else {
		alert('error please refresh the page');
	}
} // /edit contract function

// remove contract 
function removeContract(contractID = null) {
	if(contractID) {
		// remove contract button clicked
		$("#removeContractBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeContractBtn").button('loading');
			$.ajax({
				url: 'php_action/removeContract.php',
				type: 'post',
				data: {contractID: contractID},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeContractBtn").button('reset');
					if(response.success == true) {
						// remove contract modal
						$("#removeContractModal").modal('hide');

						// update the contract table
						manageContractTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {
						// remove success messages
						$(".removeContractMessages").html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
						'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} // /error
				} // /success function
			}); // /ajax fucntion to remove the contract
			return false;
		}); // /remove contract btn clicked
	} // /if contractid
} // /remove contract function

function clearForm(oForm) {

}