function addJavascript(jsname, pos) {
	var th = document.getElementsByTagName(pos)[0];
	var s = document.createElement("script");
	s.setAttribute("type", "text/javascript");
	s.setAttribute("src", jsname);
	th.appendChild(s);
}

function addStyleSheet(jsname, pos) {
	var th = document.getElementsByTagName(pos)[0];
	var s = document.createElement("link");
	s.setAttribute("type", "text/css");
	s.setAttribute("href", jsname);
	th.appendChild(s);
}

function ajax_chosen(id, page_url) {
	var ids = $('#' + id);
	if (ids[0]) {
		if (page_url != 'load_inside') {
			$(ids)
					.ajaxChosen(
							{
								dataType : 'json',
								type : 'POST',

								url : site_url + page_url
							},
							{
								generateUrl : function(q) {
									return site_url + page_url
											+ encodeURIComponent($(ids).val())
								},
								loadingImg : baseUrl
										+ 'resources/vitc/js/plugins/chosen/loading.gif'
							});
		} else {
			$(ids)
					.chosen(

							{
								loadingImg : baseUrl
										+ 'resources/vitc/js/plugins/chosen/loading.gif'
							}
							);
		}
	}
	
	$('.chzn-select').trigger("liszt:updated");
	
}