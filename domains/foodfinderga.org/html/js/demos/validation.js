$(function () {

	var rules = {
		    	rules: {
					product_name: {
						minlength: 3,
						required: true,
					},
					supplier_name: {
						minlength: 3,
						required: true
					},
					price: {
						minlength: 1,
						required: true
					},
					location: {
						minlength: 3,
						required: true
					},
					name: {
						minlength: 2,
						required: true
					},
					department: {
						required: true
					}
				}
		    };
		
	    var validationObj = $.extend (rules, Theme.validationRules);
	    
		$('form').validate(validationObj);
		
		if ($('#notify_text').length) {
			$.msgGrowl({
				type : 'success',
				title : 'Success',
				text : $("#notify_text").html()
			});
		}

		if ($('#error_text').length) {
			$.msgGrowl({
				type : 'error',
				title : 'Error',
				text : $("#error_text").html()
			});
		}
		
		$('.chosen').chosen();
		
});