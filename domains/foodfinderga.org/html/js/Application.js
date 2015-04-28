$(function() {

	$.validator.addMethod("validChar", function(value, element) {
		return this.optional(element) || /^[a-z0-9\- ]+$/i.test(value);
	}, "This field contains Invalid Characters.");

	var rules = {
		rules : {
			o_password : {
				required : true,
				minlength : 5				
			},
			n_password : {
				required : true,
				minlength : 5				
			},
			c_password : {
				required : true,
				equalTo :'#n_password'
			},
			gid : {
				required : true
			},
			orderid : {
				required : true
			},
			returnreason : {
				required : true,
				minlength : 3,
			},
			date : {
				required : true
			},
			month : {
				required : true
			},
			year : {
				required : true
			},
			email : {
				required : true,
				email : true
			},
			password : {
				required : true,
				minlength : 5				
			},
			name : {
				required : true,
				minlength : 3
			},
			schooladdress1 : {
				required : true,
			},
			city : {
				required : true,
			},
			state : {
				required : true,
			},
			zipcode : {
				required : true,
			},
			providername : {
				required : true,
			},
			streetaddress1 : {
				required : true,
			},
			schooladdress : {
				required : true,
			},	
			homeaddress : {
				required : true,
			},
			schoolname : {
				required : true
			}

		}
	};

	var validationObj = $.extend(rules, Theme.validationRules);
	if ($('form').length) {
		$('form').validate(validationObj);
	}

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

	if ($('#notify_info').length) {
		$.msgGrowl({
			type : 'info',
			title : 'Info',
			text : $("#notify_info").html()
		});
	}

	$('#butcancel').click(function() {
		location.reload();
	});
	Theme.init();

	//$('.chosen').chosen();

});
