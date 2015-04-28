$('.product-delete')
		.live(
				'click',
				function(e) {
					//title = $(this).attr('title').toUpperCase();
					id = $(this).attr('id');
					$.msgbox(
									"Are you sure that you want to delete the product "
											,
									{
										type : "confirm",
										buttons : [ {
											type : "submit",
											value : "Yes"
										}, {
											type : "submit",
											value : "No"
										} ]
									},
									function(result) {
										if (result == "Yes") {

											$
													.post(
															site_url
																	+ "/product/delete_product",
															{
																product_id : id
															})
													.done(
															function(data) {
																$
																		.msgbox(
																				"The Product deleted Successfully",
																				{
																					type : "confirm",
																					buttons : [ {
																						type : "submit",
																						value : "Okay"
																					} ]
																				},
																				function(
																						result) {
																					if (result == "Okay") {
																						window.location.href = site_url
																								+ '/product/manageproduct';
																					}
																				});
															});
										}
									});
				});
$(document).ready(function() {
	$('body').tooltip({
	    selector: '[rel=tooltip]'
	});
});
