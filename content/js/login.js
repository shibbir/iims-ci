$(function () {
	$(document).on('event/ajax-start', function () {
		$('.btn-ajax').hide();
		$('.btn-loading').show();
	});

	$(document).on('event/ajax-end', function () {
		$('.btn-ajax').show();
		$('.btn-loading').hide();
	});

	$(document).on('click', '.btn-login', function () {
		$(document).trigger('event/ajax-start');
		var base_url = window.location.protocol + '//' + window.location.host + '/IIMSApp-CI/';

		$.ajax({
			url: base_url + 'welcome/checkLoginCredintials',
			type: 'POST',
			data: $('.user-login-form').serialize(),
			dataType: 'json',
			success: function (data) {
				if(data.status === 'error') {
					$(document).trigger('event/ajax-end');
					showNotification(data, '#notification-login');
				} else {
					window.location = base_url + 'dashboard';
				}
			}
		});
	});
});