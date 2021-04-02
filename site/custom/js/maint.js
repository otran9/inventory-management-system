var manageMaintTable;

$(document).ready(function() {
	// top nav bar 
	$('#navMaint').addClass('active');
	// manage maint data table
	// alert ("maint.js calling (document).ready(function())");
	manageMaintTable = $('#manageMaintTable').DataTable({
		'ajax': 'php_action/fetchMaint.php',
		'order': []
	});

	// add maint modal btn clicked
	$("#addMaintModalBtn").unbind('click').bind('click', function() {
		// // maint form reset
		$("#submitMaintForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		/*
		$("#maintImage").fileinput({
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
		
		// due date picker
		$("#dueDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		// date completed picker
		$("#dateCompleted").datepicker({
			dateFormat: 'yy-mm-dd'
		});
				
		// submit maint form
		$("#submitMaintForm").unbind('submit').bind('submit', function() {
			// form validation
			var title = $("#title").val();
			var details = $("#details").val();
			var dueDate = $("#dueDate").val();
			var maintBy = $("#maintBy").val();
			var maintStatus = $("#maintStatus").val();
			var dateCompleted = $("#dateCompleted").val();
			var repairsCost = $("#repairsCost").val();
			var repeating = $("#repeating").val();
			var assetTagID = $("#assetTagID").val();

			if(title == "") {
				$("#title").after('<p class="text-danger">Maintenance Title is required</p>');
				$('#title').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#title").find('.text-danger').remove();
				// success out for form 
				$("#title").closest('.form-group').addClass('has-success');
			}	// /else

			if(details == "") {
				$("#details").after('<p class="text-danger">Details is required</p>');
				$('#details').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#details").find('.text-danger').remove();
				// success out for form 
				$("#details").closest('.form-group').addClass('has-success');	  	
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

			if(title && details && assetTagID) {
				// submit loading button
				$("#createMaintBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);
				
				//alert("title: " + title);
				//alert("details: " + details);
				//alert("assetID: " + assetTagID); // OTRAN
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
							$("#createMaintBtn").button('reset');
							
							//NTRAN 
							//alert("BEFORE submitMaintForm reset");
							
							$("#submitMaintForm")[0].reset();

							//NTRAN 
							//alert("AFTER submitMaintForm reset");

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-maint-messages').html('<div class="alert alert-success">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							'</div>');

							// remove the mesages
							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$('#addMaintModal').modal('hide');
									//$(this).remove();
								});
							}); // /.alert

							// reload the manage maint table
							manageMaintTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');
							
							/*
							// OTRAN - Close Add Maint Modal Form only at success
							$(this).delay(3000).hide(10, function() {
								$('#addMaintModal').modal('hide');
								
								// Reload the page
								window.location.reload(true);
							});
							*/
						} // /if response.success
					} // /success function
				}); // /ajax function
			} // /if validation is ok
			
			return false;
		}); // /submit maint form
	}); // /add maint modal btn clicked
}); // document.ready function

function editMaint(maintNumber = null) {
	if(maintNumber) {
		//alert("ENTERING function editMaint | maintNumber: " + maintNumber); //OTRAN

		$("#maintNumber").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');
		
		
		// due date picker
		$("#editDueDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		// date completed picker
		$("#editDateCompleted").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		
		$.ajax({
			url: 'php_action/fetchSelectedMaint.php',
			type: 'post',
			data: {maintNumber: maintNumber},
			dataType: 'json',
			success:function(response) {			
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				//$("#getMaintImage").attr('src', 'stock/'+response.maint_image);

				//$("#editMaintImage").fileinput({		      
				//});  

				// $("#editMaintImage").fileinput({
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
				//    defaultPreviewContent: '<img src="stock/'+response.maint_image+'" alt="Profile Image" style="width:100%;">',
				//    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
				// 		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				// });  

				// maint number 
				$(".editMaintFooter").append('<input type="hidden" name="maintNumber" id="maintNumber" value="'+response.maintNumber+'" />');				
				$(".editMaintPhotoFooter").append('<input type="hidden" name="maintNumber" id="maintNumber" value="'+response.maintNumber+'" />');
				
				$("#editTitle").val(response.title);
				$("#editDetails").val(response.details);
				$("#editDueDate").val(response.dueDate);
				$("#editMaintBy").val(response.maintBy);
				$("#editMaintStatus").val(response.maintStatus);
				$("#editDateCompleted").val(response.dateCompleted);
				$("#editRepairsCost").val(response.repairsCost);
				$("#editRepeating").val(response.repeating);
				$("#editAssetTagID").val(response.assetID);

				// update the maint data function
				$("#editMaintForm").unbind('submit').bind('submit', function() {
					var title = $("#editTitle").val();
					var details = $("#editDetails").val();
					var dueDate = $("#editDueDate").val();
					var maintBy = $("#editMaintBy").val();
					var maintStatus = $("#editMaintStatus").val();
					var dateCompleted = $("#editDateCompleted").val();
					var repairsCost = $("#editRepairsCost").val();
					var repeating = $("#editRepeating").val();
					var assetTagID = $("#editAssetTagID").val();

					if(title == "") {
						$("#editTitle").after('<p class="text-danger">Title is required</p>');
						$('#editTitle').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editTitle").find('.text-danger').remove();
						// success out for form 
						$("#editTitle").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(details == "") {
						$("#editDetails").after('<p class="text-danger">Details is required</p>');
						$('#editDetails').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editDetails").find('.text-danger').remove();
						// success out for form 
						$("#editDetails").closest('.form-group').addClass('has-success');	  	
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

					if(title && details && assetTagID) {
						//alert("Tag ID: " + title);
						// submit loading button
						$("#editMaintBtn").button('loading');

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
									$("#editMaintBtn").button('reset');
									
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-maint-messages').html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									'</div>');

									// remove the mesages
									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$('#editMaintModal').modal('hide');
											//$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageMaintTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');
								} // /if response.success
							} // /success function
						}); // /ajax function
						/*
						// OTRAN Auto close the editMaintModal form
						$(this).delay(3000).hide(10, function() {
							$('#editMaintModal').modal('hide');
							
							// Reload the page to be able to continue editing
							window.location.reload(true);
						});
						*/
					} // if validation is ok
					
					return false;
				}); // update the maint data function

				/*
				// update the maint image				
				$("#updateMaintImageForm").unbind('submit').bind('submit', function() {
					// form validation
					var maintImage = $("#editMaintImage").val();					
					
					if(maintImage == "") {
						$("#editMaintImage").closest('.center-block').after('<p class="text-danger">Maint Image field is required</p>');
						$('#editMaintImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMaintImage").find('.text-danger').remove();
						// success out for form 
						$("#editMaintImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(maintImage) {
						// submit loading button
						$("#editMaintImageBtn").button('loading');

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
									$("#editMaintImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-maintPhoto-messages').html('<div class="alert alert-success">'+
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
									manageMaintTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchMaintImageUrl.php?i='+maintID,
										type: 'post',
										success:function(response) {
										$("#getMaintImage").attr('src', response);		
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
				}); // /update the maint image
				*/

			} // /success function
		}); // /ajax to fetch maint image
	} else {
		alert('error please refresh the page');
	}
} // /edit maint function

// remove maint 
function removeMaint(maintNumber = null) {
	if(maintNumber) {
		// remove maint button clicked
		$("#removeMaintBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeMaintBtn").button('loading');
			$.ajax({
				url: 'php_action/removeMaint.php',
				type: 'post',
				data: {maintNumber: maintNumber},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeMaintBtn").button('reset');
					if(response.success == true) {
						// remove maint modal
						$("#removeMaintModal").modal('hide');

						// update the maint table
						manageMaintTable.ajax.reload(null, false);

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
						$(".removeMaintMessages").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the maint
			return false;
		}); // /remove maint btn clicked
	} // /if maintid
} // /remove maint function

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