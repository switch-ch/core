$(document).ready(function(){
	if (OC.currentUser) {
		// Personal settings
		var $el = $('#avatar .avatardiv');
		if ($el.length > 0) {
			$el.avatar(OC.currentUser, 128);
		}
		// Top avatar
		$el = $('#settings .avatardiv');
		if ($el.css('display') !== 'none') {
			$el.avatar(OC.currentUser, 32, undefined, true);
		}
	}
	// User settings
	$.each($('td.avatar .avatardiv'), function(i, element) {
		$(element).avatar($(element).parent().parent().data('uid'), 32);
	});
});
