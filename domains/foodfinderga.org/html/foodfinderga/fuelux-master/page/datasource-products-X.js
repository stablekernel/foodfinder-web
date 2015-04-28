$('#MyGrid').datagrid(
				{
					dataSource : new MessageDataSource(
							{

								// Column definitions for Datagrid
								url : '/product/json_products/',
								columns : [ {
									property : 'product_name',
									label : 'Name',
									sortable : false
								}, {
									property : 'product_code',
									label : 'Code',
									sortable : false
								}, {
									property : 'supplier_name',
									label : 'Supplier Name',
									sortable : false
								}, {
									property : 'product_view',
									label : 'View',
									sortable : false
								}, {
									property : 'product_edit',
									label : 'Edit',
									sortable : false
								}, {
									property : 'product_delete',
									label : 'Delete',
									sortable : false
								} ],
							  data: {name: product_name},

								// Create IMG tag for each returned image
								formatter : function(items) {
									$
											.each(
													items,
													function(index, item) {
														if(item.product_code==null) item.product_code="";
														if(item.supplier_name==null) item.supplier_name="";

																item.product_view = "<a href='"
																		+ ARNY.siteUrl
																		+ "/product/view_product/"
																		+ item.product_id
																		+ "' class='view_message' rel='tooltip' title='Click here to View'> </a>",
																item.product_edit = "<a href='"
																		+ ARNY.siteUrl
																		+ "/product/edit_product/"
																		+ item.product_id
																		+ "' class='custedit' rel='tooltip' title='Click here to Edit'> </a>",
																item.product_delete = "<a href='javascript:;' rel='tooltip' class='product-delete custdeactiveie' title='"
																		+ "Click here to delete"
																		+ "' id='"
																		+ item.product_id
																		+ "'> </a>"

													});
								}
							})
				});

$('.product-delete')
		.live(
				'click',
				function(e) {
					//title = $(this).attr('title').toUpperCase();
					id = $(this).attr('id');
					$
							.msgbox(
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
