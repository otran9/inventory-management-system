var manageAssetTable;

$(document).ready(function() {
	// top nav bar 
	$('#navAsset').addClass('active');
	// manage asset data table
	// alert ("asset.js calling (document).ready(function())");
	manageAssetTable = $('#manageAssetTable').DataTable({
		'ajax': 'php_action/fetchAsset.php',
		'order': []
	});
	// alert ("AFTER asset.js calling (document).ready(function())");

	// add asset modal btn clicked
	$("#addAssetModalBtn").unbind('click').bind('click', function() {	
		// // asset form reset
		$("#submitAssetForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		/*
		$("#assetImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
		});
		*/

		// submit asset form
		$("#submitAssetForm").unbind('submit').bind('submit', function() {
			// form validation
			var assetTagID = $("#assetTagID").val();
			var assetDescription = $("#assetDescription").val();
			var assetGeoTags = $("#assetGeoTags").val();
			var purchaseDate = $("#purchaseDate").val();
			var purchaseFrom = $("#purchaseFrom").val();
			var cost = $("#cost").val();
			var brand = $("#brand").val();
			var model = $("#model").val();
			var serialNo = $("#serialNo").val();

			if(assetTagID == "") {
				$("#assetTagID").after('<p class="text-danger">Asset Tag ID field is required</p>');
				$('#assetTagID').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#assetTagID").find('.text-danger').remove();
				// success out for form 
				$("#assetTagID").closest('.form-group').addClass('has-success');
			}	// /else

			if(assetDescription == "") {
				$("#assetDescription").after('<p class="text-danger">Asset Description is required</p>');
				$('#assetDescription').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#assetDescription").find('.text-danger').remove();
				// success out for form 
				$("#assetDescription").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(assetTagID && assetDescription) {
				// submit loading button
				$("#createAssetBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);
				
				alert("BEFORE ajax call");
				var getData; // OTRAN
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					/*
					*/
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {
						getData[name] = response;
						alert("response.success = " + response.success);
						if(response.success == true) {
							// submit loading button
							$("#createAssetBtn").button('reset');
							alert("BEFORE submitAssetForm reset");
							$("#submitAssetForm")[0].reset();
							alert("AFTER submitAssetForm reset");

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-asset-messages').html('<div class="alert alert-success">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							'</div>');

							// remove the mesages
							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

							// reload the manage student table
							manageAssetTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');
						} // /if response.success
					} // /success function
				}); // /ajax function
				alert("AFTER ajax call");
				// alert(getData[name]); // getData[name] = {"success":true,"messages":"Successfully Added"}
			}	 // /if validation is ok 					
			return false;
		}); // /submit asset form
	}); // /add asset modal btn clicked
	// remove asset 	

}); // document.ready fucntion

function editAsset(assetID = null) {

	if(assetID) {
		$("#assetID").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedAsset.php',
			type: 'post',
			data: {assetID: assetID},
			dataType: 'json',
			success:function(response) {		
			// alert(response.asset_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				//$("#getAssetImage").attr('src', 'stock/'+response.asset_image);

				//$("#editAssetImage").fileinput({		      
				//});  

				// $("#editAssetImage").fileinput({
		  //     overwriteInitial: true,
			 //    maxFileSize: 2500,
			 //    showClose: false,
			 //    showCaption: false,
			 //    browseLabel: '',
			 //    removeLabel: '',
			 //    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			 //    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			 //    removeTitle: 'Cancel or reset changes',
			 //    elErrorContainer: '#kv-avatar-errors-1',
			 //    msgErrorClass: 'alert alert-block alert-danger',
			 //    defaultPreviewContent: '<img src="stock/'+response.asset_image+'" alt="Profile Image" style="width:100%;">',
			 //    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		  // 		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				// });  

				// asset id 
				$(".editAssetFooter").append('<input type="hidden" name="assetID" id="assetID" value="'+response.assetID+'" />');				
				$(".editAssetPhotoFooter").append('<input type="hidden" name="assetID" id="assetID" value="'+response.assetID+'" />');
				
				// asset tag id
				$("#editAssetTagID").val(response.assetTagID);
				$("#editAssetDescription").val(response.assetDescription);
				$("#editAssetGeoTags").val(response.assetGeoTags);
				$("#editPurchaseDate").val(response.purchaseDate);
				$("#editPurchaseFrom").val(response.purchaseFrom);
				$("#editCost").val(response.cost);
				$("#editBrand").val(response.brand);
				$("#editModel").val(response.model);
				$("#editSerialNo").val(response.serialNo);

				// update the asset data function
				$("#editAssetForm").unbind('submit').bind('submit', function() {
					var assetTagID = $("#editAssetTagID").val();
					var assetDescription = $("#editAssetDescription").val();
					var assetGeoTags = $("#editAssetGeoTags").val();
					var purchaseDate = $("#editPurchaseDate").val();
					var purchaseFrom = $("#editPurchaseFrom").val();
					var cost = $("#editCost").val();
					var brand = $("#editBrand").val();
					var model = $("#editModel").val();
					var serialNo = $("#editSerialNo").val();						

					if(assetTagID == "") {
						$("#editAssetTagID").after('<p class="text-danger">Asset Name field is required</p>');
						$('#editAssetTagID').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAssetTagID").find('.text-danger').remove();
						// success out for form 
						$("#editAssetTagID").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(assetDescription == "") {
						$("#editAssetDescription").after('<p class="text-danger">Quantity field is required</p>');
						$('#editAssetDescription').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAssetDescription").find('.text-danger').remove();
						// success out for form 
						$("#editAssetDescription").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(assetTagID && assetDescription) {
						// submit loading button
						$("#editAssetBtn").button('loading');

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
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editAssetBtn").button('reset');
									
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-asset-messages').html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									'</div>');

									// remove the mesages
									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageAssetTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the asset data function

				/*
				// update the asset image				
				$("#updateAssetImageForm").unbind('submit').bind('submit', function() {
					// form validation
					var assetImage = $("#editAssetImage").val();					
					
					if(assetImage == "") {
						$("#editAssetImage").closest('.center-block').after('<p class="text-danger">Asset Image field is required</p>');
						$('#editAssetImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAssetImage").find('.text-danger').remove();
						// success out for form 
						$("#editAssetImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(assetImage) {
						// submit loading button
						$("#editAssetImageBtn").button('loading');

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
								
								if(response.success == true) {
									// submit loading button
									$("#editAssetImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-assetPhoto-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageAssetTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchAssetImageUrl.php?i='+assetID,
										type: 'post',
										success:function(response) {
										$("#getAssetImage").attr('src', response);		
										}
									});																		

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // /update the asset image
				*/

			} // /success function
		}); // /ajax to fetch asset image
				
	} else {
		alert('error please refresh the page');
	}
} // /edit asset function

// remove asset 
function removeAsset(assetID = null) {
	if(assetID) {
		// remove asset button clicked
		$("#removeAssetBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeAssetBtn").button('loading');
			$.ajax({
				url: 'php_action/removeAsset.php',
				type: 'post',
				data: {assetID: assetID},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeAssetBtn").button('reset');
					if(response.success == true) {
						// remove asset modal
						$("#removeAssetModal").modal('hide');

						// update the asset table
						manageAssetTable.ajax.reload(null, false);

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
						$(".removeAssetMessages").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the asset
			return false;
		}); // /remove asset btn clicked
	} // /if assetid
} // /remove asset function

function clearForm(oForm) {
	// var frm_elements = oForm.elements;									
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();									
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":	    
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":	    
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file": 
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}