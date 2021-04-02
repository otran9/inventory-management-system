var manageWarrantyTable;

$(document).ready(function() {
	// top nav bar 
	$('#navWarranty').addClass('active');
	// manage warranty data table
	manageWarrantyTable = $('#manageWarrantyTable').DataTable({
		'ajax': 'php_action/fetchWarranty.php',
		'order': []
	});

	// add warranty modal btn clicked
	$("#addWarrantyModalBtn").unbind('click').bind('click', function() {
		// // warranty form reset
		$("#submitWarrantyForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		
		// due date picker
		$("#expirDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
				
		// submit warranty form
		$("#submitWarrantyForm").unbind('submit').bind('submit', function() {
			// form validation
			var length = $("#length").val();
			var expirDate = $("#expirDate").val();
			var notes = $("#notes").val();
			var assetID = $("#assetID").val();

			if(expirDate == "") {
				$("#expirDate").after('<p class="text-danger">Expiration Date is required</p>');
				$('#expirDate').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#expirDate").find('.text-danger').remove();
				// success out for form 
				$("#expirDate").closest('.form-group').addClass('has-success');
			}	// /else

			if(assetID == "") {
				$("#assetID").after('<p class="text-danger">Asset Tag ID is required</p>');
				$('#assetID').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#assetID").find('.text-danger').remove();
				// success out for form 
				$("#assetID").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(expirDate && assetID) {
				// alert("expirDate: " + expirDate);
				// submit loading button
				$("#createWarrantyBtn").button('loading');

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
						if(response.success == true) {
							// submit loading button
							$("#createWarrantyBtn").button('reset');
							
							$("#submitWarrantyForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
							// shows a successful message after operation
							$('#add-warranty-messages').html('<div class="alert alert-success">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							'</div>');

							// remove the mesages
							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$('#addWarrantyModal').modal('hide');
									//$(this).remove();
								});
							}); // /.alert

							// reload the manage warranty table
							manageWarrantyTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');
						} // /if response.success
					} // /success function
				}); // /ajax function
			} // /if validation is ok
			
			return false;
		}); // /submit warranty form
	}); // /add warranty modal btn clicked
}); // document.ready function

function editWarranty(warrantyID = null) {
	if(warrantyID) {
		//alert("ENTERING function editWarranty | warrantyID: " + warrantyID); //OTRAN

		$("#warrantyID").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');
		
		// due date picker
		$("#editExpirDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		
		$.ajax({
			url: 'php_action/fetchSelectedWarranty.php',
			type: 'post',
			data: {warrantyID: warrantyID},
			dataType: 'json',
			success:function(response) {			
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// warranty number 
				$(".editWarrantyFooter").append('<input type="hidden" name="warrantyID" id="warrantyID" value="'+response.warrantyID+'" />');				
				
				$("#editLength").val(response.length);
				$("#editExpirDate").val(response.expirDate);
				$("#editNotes").val(response.notes);
				$("#editAssetID").val(response.assetID);

				// update the warranty data function
				$("#editWarrantyForm").unbind('submit').bind('submit', function() {
					var length = $("#editLength").val();
					var expirDate = $("#editExpirDate").val();
					var notes = $("#editNotes").val();
					var assetID = $("#editAssetID").val();

					if(expirDate == "") {
						$("#editExpirDate").after('<p class="text-danger">Expiration Date is required</p>');
						$('#editExpirDate').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editExpirDate").find('.text-danger').remove();
						// success out for form 
						$("#editExpirDate").closest('.form-group').addClass('has-success');	  	
					} // else

					if(assetID == "") {
						$("#editAssetID").after('<p class="text-danger">Asset Tag ID is required</p>');
						$('#editAssetID').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAssetID").find('.text-danger').remove();
						// success out for form 
						$("#editAssetID").closest('.form-group').addClass('has-success');
					} // else

					if(expirDate && assetID) {
						// submit loading button
						$("#editWarrantyBtn").button('loading');

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
									$("#editWarrantyBtn").button('reset');
									
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-warranty-messages').html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									'</div>');

									// remove the mesages
									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$('#editWarrantyModal').modal('hide');
											//$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageWarrantyTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');
								} // /if response.success
							} // /success function
						}); // /ajax function
					} // if validation is ok
					
					return false;
				}); // update the warranty data function

			} // /success function
		}); // /ajax to fetch warranty image
	} else {
		alert('error please refresh the page');
	}
} // /edit warranty function

// remove warranty 
function removeWarranty(warrantyID = null) {
	if(warrantyID) {
		// remove warranty button clicked
		$("#removeWarrantyBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeWarrantyBtn").button('loading');
			$.ajax({
				url: 'php_action/removeWarranty.php',
				type: 'post',
				data: {warrantyID: warrantyID},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeWarrantyBtn").button('reset');
					if(response.success == true) {
						// remove warranty modal
						$("#removeWarrantyModal").modal('hide');

						// update the warranty table
						manageWarrantyTable.ajax.reload(null, false);

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
						$(".removeWarrantyMessages").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the warranty
			return false;
		}); // /remove warranty btn clicked
	} // /if warrantyid
} // /remove warranty function

function clearForm(oForm) {

}