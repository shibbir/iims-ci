var IIMSApp = IIMSApp || {};

IIMSApp.base_url = window.location.protocol + '//' + window.location.host + '/IIMSApp-CI/';
IIMSApp.newlyCreatedProductId = 0;
IIMSApp.newlyCreatedCustomerId = 0;
IIMSApp.newlyEditedCustomerId = 0;

$('#datePicker').kendoDatePicker({
	format: 'dd MMMM, yyyy',
    value: new Date()
});

$(document).trigger('event/templateRendered');

$(document).on('event/templateRendered', function () {
	$('select').kendoDropDownList();
	$('input[type=number].qty').kendoNumericTextBox({
		format: '# Pcs'
	});
	$('input[type=number].currency').kendoNumericTextBox({
		format: '# tk',
		decimals: 3
	});
});

$(function () {
	var label = $('label');
	label.each(function () {
		if($(this).data('required') == '1') {
			$(this).append('<span class="red">*</span>');
		}
	});
});