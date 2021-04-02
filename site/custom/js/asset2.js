var manageAssetTable;

$(document).ready(function() {
	var divRequest = $(".div-request").text();

	// top nav bar 
	$("#navAsset").addClass('active');

	if (divRequest == 'addAsset')  {
		// add asset	
		// top nav child bar 
		$('#topNavAddAsset').addClass('active');	

		// purchase date picker
		$("#purchaseDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});

		// create asset form function
		$("#createAssetForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			
			var assetTagID = $("#assetTagID").val();
			var assetDescription = $("#assetDescription").val();
			//var assetGeoTags = $("#assetGeoTags").val(); // Only show when asset is scanned by user (Active status)
			var purchaseDate = $("#purchaseDate").val();
			var purchaseFrom = $("#purchaseFrom").val();
			var cost = $("#cost").val();
			var categories_id = $("#categories_id").val();
			var brand = $("#brand").val();
			var model = $("#model").val();
			var serialNo = $("#serialNo").val();
			//var asset_image = $("#asset_image").val();
			var user_id = $("#user_id").val();
			//var status = "Available"; // Can set in createAsset2.php
			// var activeDate = $("#activeDate").val(); // Set date of scanning
			//var contractID = $("#contractID").val();
			//var warrantyID = $("#warrantyID").val();
			var departmentID = $("#departmentID").val();
			var siteID = $("#siteID").val();
			var locationID = $("#locationID").val();

			// form validation
			if(assetTagID == "") {
				$("#assetTagID").after('<p class="text-danger"> Asset Tag ID is required </p>');
				$('#assetTagID').closest('.form-group').addClass('has-error');
			} else {
				$('#assetTagID').closest('.form-group').addClass('has-success');
			} // /else

			if(assetDescription == "") {
				$("#assetDescription").after('<p class="text-danger"> Asset Description is required </p>');
				$('#assetDescription').closest('.form-group').addClass('has-error');
			} else {
				$('#assetDescription').closest('.form-group').addClass('has-success');
			} // /else

			if(assetTagID && assetDescription) {
				alert(	"tag id: " + assetTagID +
						"\ndesc: " + assetDescription);
				console.log(	"tag id: " + assetTagID +
								"\ndesc: " + assetDescription);

				// create asset button
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),	
					dataType: 'json',
					success:function(response) {
						console.log(response);
						alert("response.success: " + response.success);
						console.log("response.success: " + response.success);
						// reset button
						$("#createAssetBtn").button('reset');
						
						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

						if(response.success == true) {
							alert("Before success message");

							// create asset button
							$(".success-messages").html('<div class="alert alert-success">'+
			            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            	'<a href="asset2.php?a=addAsset" class="btn-custom btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Asset </a>'+
			   		    	'</div>');

			   		    	/*
							// create asset button
							$(".success-messages").html('<div class="alert alert-success">'+
			            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            	' <br /> <br /> <a type="button" onclick="printAsset('+response.assetID+')" class="btn-custom btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>'+
			            	'<a href="asset2.php?a=addAsset" class="btn-custom btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Asset </a>'+
			   		    	'</div>');
			   		    	*/

							alert("After success message");

							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled the modal footer button
							$(".submitButtonFooter").addClass('div-hide');
						} else {
							alert(response.messages);								
						}
					} // /response
				}); // /ajax
			} // /if field validate is true
			
			return false;
		}); // /create asset form function

		// ADD CATEGORIES MODAL
		$('#addCategoriesModalBtn').unbind('click').bind('click', function() {
			// reset the form text
			$("#submitCategoriesForm")[0].reset();
			// remove the error text
			$(".text-danger").remove();
			// remove the form error
			$('.form-group').removeClass('has-error').removeClass('has-success');

			// submit categories form function
			$("#submitCategoriesForm").unbind('submit').bind('submit', function() {
				var categoriesName = $("#categoriesName").val();
				var categoriesStatus = 1;
				alert("submitCategoriesForm status: " + categoriesStatus);

				if(categoriesName == "") {
					$("#categoriesName").after('<p class="text-danger"> Category Name is required</p>');
					$('#categoriesName').closest('.form-group').addClass('has-error');
				} else {
					// remov error text field
					$("#categoriesName").find('.text-danger').remove();
					// success out for form 
					$("#categoriesName").closest('.form-group').addClass('has-success');	  	
				}

				if(categoriesName) {
					var form = $(this);
					// button loading
					$("#createCategoriesBtn").button('loading');
					alert("if categoriesName status: " + categoriesStatus);

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {
								// NOT REACHING HERE YET ADDING CATEGORIES
								alert("response.success: " + response.success);
								alert("status: " + categoriesStatus);
								// button loading
								$("#createCategoriesBtn").button('reset');

		  	  					// reset the form text
								$("#submitCategoriesForm")[0].reset();

								$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

				  	  			$('#add-categories-messages').html('<div class="alert alert-success">'+
				            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					        	'</div>');

		  	  					$(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$('#addCategoriesModal').modal('hide');
										//$(this).remove();
									});
								}); // /.alert

								// reload the manage asset table 
								manageAssetTable.ajax.reload(null, false);
								//manageCategoriesTable.ajax.reload(null, false);						

								// remove the error text
								$(".text-danger").remove();

								// remove the form error
								$('.form-group').removeClass('has-error').removeClass('has-success');
							}  // if
						} // /success
					}); // /ajax	
				} // if

				return false;
			}); // submit categories form function
		}); // /on click on submit categories form modal



	} else if (divRequest == 'manageAsset') {
		// top nav child bar 
		$('#topNavManageAsset').addClass('active');

		manageAssetTable = $("#manageAssetTable").DataTable({
			'ajax': 'php_action/fetchAsset2.php',
			'asset': []
		});

	} else if (divRequest == 'editAsset') {
		// purchase date picker
		$("#purchaseDate").datepicker({
			dateFormat: 'yy-mm-dd'
		});

		// edit asset form function
		$("#editAssetForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			
			var assetTagID = $("#assetTagID").val();
			var assetDescription = $("#assetDescription").val();
			//var assetGeoTags = $("#assetGeoTags").val(); // Only show when asset is scanned by user (Active status)
			var purchaseDate = $("#purchaseDate").val();
			var purchaseFrom = $("#purchaseFrom").val();
			var cost = $("#cost").val();
			var categories_id = $("#categories_id").val();
			var brand = $("#brand").val();
			var model = $("#model").val();
			var serialNo = $("#serialNo").val();
			//var asset_image = $("#asset_image").val();
			var user_id = $("#user_id").val();
			var status = $("#status").val();
			// var activeDate = $("#activeDate").val(); // Set date of scanning
			//var contractID = $("#contractID").val();
			//var warrantyID = $("#warrantyID").val();
			var departmentID = $("#departmentID").val();
			var siteID = $("#siteID").val();
			var locationID = $("#locationID").val();

			// form validation 
			if (assetTagID == "") {
				$("#assetTagID").after('<p class="text-danger"> Asset Tag ID is required </p>');
				$('#assetTagID').closest('.form-group').addClass('has-error');
			} else {
				$('#assetTagID').closest('.form-group').addClass('has-success');
			} // /else

			if (assetDescription == "") {
				$("#assetDescription").after('<p class="text-danger"> Asset Description is required </p>');
				$('#assetDescription').closest('.form-group').addClass('has-error');
			} else {
				$('#assetDescription').closest('.form-group').addClass('has-success');
			} // /else

			if(assetTagID && assetDescription) {
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						console.log(response);
						// reset button
						$("#editAssetBtn").button('reset');
						
						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

						if(response.success == true) {
							//alert("edit");

							// success messages
							$(".success-messages").html('<div class="alert alert-success">'+
	            			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	   		       			'</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

	  	  					$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									//$(this).remove();
									window.location.reload(true);
								});
							}); // /.alert

							// disabled the modal footer button
							//$(".editButtonFooter").addClass('div-hide');
						} else {
							alert(response.messages);
						}
					} // /response
				}); // /ajax
			} // /if field validate is true
			
			return false;
		}); // /edit asset form function

		/*
		// CHECK OUT MODAL FROM WITHIN EDIT VIEW
		$("#checkOutAssetBtn").unbind('click').bind('click', function() {
			//$("#checkOutAssetBtn").button('loading');

			//alert("checkOut before alert");
			$.ajax({
				url: 'php_action/checkOutAsset.php',
				type: 'post',
				data: {assetID : assetID},
				dataType: 'json',
				success:function(response) {
					$("#checkOutAssetBtn").button('reset');

					if (response.success == true) {
						manageAssetTable.ajax.reload(null, false);

						// hide modal
						$("#checkOutAssetModal").modal('hide');
						//alert("checkout");

						// success messages
						$("#success-messages").html(	'<div class="alert alert-success">' +
														'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
														'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>' + response.messages +
														'</div>');

						// remove the messages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert-success
					} else {
						// error messages
						$(".checkOutAssetMessages").html(	'<div class="alert alert-warning">' +
															'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
															'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>' + response.messages +
															'</div>');

						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert-success
					} // /else
				} // /success
			}); // /ajax function to check out the asset
		}); // /check out asset button clicked
		*/

	} // /else
}); // /document

function resetAssetForm() {
	// reset the input field
	$("#createAssetForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset asset form

/*
*/
// check out asset
function checkOutAsset(assetID = null) {
	if (assetID) {
		// CHECK OUT MODAL FROM TABLE VIEW
		$("#checkOutAssetBtn").unbind('click').bind('click', function() {
			//$("#checkOutAssetBtn").button('loading');

			$.ajax({
				url: 'php_action/checkOutAsset.php',
				type: 'post',
				data: {assetID : assetID},
				dataType: 'json',
				success:function(response) {
					$("#checkOutAssetBtn").button('reset');

					if (response.success == true) {
						manageAssetTable.ajax.reload(null, false);

						// hide modal
						$("#checkOutAssetModal").modal('hide');
						alert("checkout in ajax");

						// success messages
						$("#success-messages").html(	'<div class="alert alert-success">' +
														'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
														'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>' + response.messages +
														'</div>');

						// remove the messages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert-success
					} else {
						// error messages
						$(".checkOutAssetMessages").html(	'<div class="alert alert-warning">' +
															'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
															'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>' + response.messages +
															'</div>');

						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert-success
					} // /else
				} // /success
			}); // /ajax function to check out the asset


		}); // /check out asset button clicked
	} else {
		alert('error! refresh the page again');
	}
}

// scan asset
function scanAsset(assetID = null) {
	if (assetID) {
		// SCAN MODAL FROM TABLE VIEW
		$("#scanAssetBtn").unbind('click').bind('click', function() {
			//$("#scanAssetBtn").button('loading');

			$.ajax({
				url: 'php_action/scanAsset.php',
				type: 'post',
				data: {assetID : assetID},
				dataType: 'json',
				success:function(response) {
					$("#scanAssetBtn").button('reset');

					if (response.success == true) {
						manageAssetTable.ajax.reload(null, false);

						// hide modal
						$("#scanAssetModal").modal('hide');
						//alert("scan in ajax");

						// success messages
						$("#success-messages").html(	'<div class="alert alert-success">' +
														'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
														'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>' + response.messages +
														'</div>');

						// remove the messages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert-success
					} else {
						// error messages
						$(".scanAssetMessages").html(	'<div class="alert alert-warning">' +
															'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
															'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>' + response.messages +
															'</div>');

						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert-success
					} // /else
				} // /success
			}); // /ajax function to scan the asset


		}); // /scan asset button clicked
	} else {
		alert('error! refresh the page again');
	}
}

// remove asset from server
function removeAsset(assetID = null) {
	if(assetID) {
		//alert("assetID: " + assetID);
		$("#removeAssetBtn").unbind('click').bind('click', function() {
			$("#removeAssetBtn").button('loading');

			$.ajax({
				url: 'php_action/removeAsset.php',
				type: 'post',
				data: {assetID : assetID},
				dataType: 'json',
				success:function(response) {
					$("#removeAssetBtn").button('reset');

					if(response.success == true) {
						manageAssetTable.ajax.reload(null, false);
						// hide modal
						$("#removeAssetModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
	            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			        	'</div>');

						// remove the mesages
	        			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removeAssetMessages").html('<div class="alert alert-warning">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			        	'</div>');

						// remove the mesages
	        			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the asset

		}); // /remove asset button clicked
		
	} else {
		alert('error! refresh the page again');
	}
}
// /remove asset from server





// print asset function
function printAsset(assetID = null) {
	if(assetID) {		
			
		$.ajax({
			url: 'php_action/printAsset.php',
			type: 'post',
			data: {assetID: assetID},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Asset Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.resizeTo(screen.width, screen.height);
setTimeout(function() {
    mywindow.print();
    mywindow.close();
}, 1250);

        //mywindow.print();
        //mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if assetID
} // /print order function

function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'php_action/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+

					'<select class="form-control" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">~~SELECT~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value[0]+'">'+value[1]+'</option>';							
						});
													
					tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;"">'+
					'<input type="text" name="rate[]" id="rate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<p id="available_quantity'+count+'"></p>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getProductData(row = null) {

	if(row) {
		var productId = $("#productName"+row).val();		
		
		if(productId == "") {
			$("#rate"+row).val("");

			$("#quantity"+row).val("");						
			$("#total"+row).val("");

			// remove check if product name is selected
			// var tableProductLength = $("#productTable tbody tr").length;			
			// for(x = 0; x < tableProductLength; x++) {
			// 	var tr = $("#productTable tbody tr")[x];
			// 	var count = $(tr).attr('id');
			// 	count = count.substring(3);

			// 	var productValue = $("#productName"+row).val()

			// 	if($("#productName"+count).val() == "") {					
			// 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');	
			// 		console.log("#changeProduct"+count);
			// 	}											
			// } // /for

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#rate"+row).val(response.rate);
					$("#rateValue"+row).val(response.rate);

					$("#quantity"+row).val(1);
					$("#available_quantity"+row).text(response.quantity);

					var total = Number(response.rate) * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					
					// check if product name is selected
					// var tableProductLength = $("#productTable tbody tr").length;					
					// for(x = 0; x < tableProductLength; x++) {
					// 	var tr = $("#productTable tbody tr")[x];
					// 	var count = $(tr).attr('id');
					// 	count = count.substring(3);

					// 	var productValue = $("#productName"+row).val()

					// 	if($("#productName"+count).val() != productValue) {
					// 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');	
					// 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');								
					// 		console.log("#changeProduct"+count);
					// 	}											
					// } // /for
			
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

// table total
function getTotal(row = null) {
	if(row) {
		var total = Number($("#rate"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#subTotal").val())/100) * 18;
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	var discount = $("#discount").val();
	if(discount) {
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#paid").val();
	if(paidAmount) {
		paidAmount =  Number($("#grandTotal").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {	
		$("#due").val($("#grandTotal").val());
		$("#dueValue").val($("#grandTotal").val());
	} // else

} // /sub total amount

function discountFunc() {
	var discount = $("#discount").val();
 	var totalAmount = Number($("#totalAmount").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
 		grandTotal = grandTotal.toFixed(2);

 		$("#grandTotal").val(grandTotal);
 		$("#grandTotalValue").val(grandTotal);
 	} else {
 	}

 	var paid = $("#paid").val();

 	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#due").val(dueAmount);
 		$("#dueValue").val(dueAmount);
 	} else {
 		$("#due").val($("#grandTotal").val());
 		$("#dueValue").val($("#grandTotal").val());
 	}

} // /discount function

function paidAmount() {
	var grandTotal = $("#grandTotal").val();

	if(grandTotal) {
		var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amoutn function