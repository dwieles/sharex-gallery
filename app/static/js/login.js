$(document).ready(async () => {
	$(document).keypress(function(e) {
		if(e.which == 13) {
			$('#form-submit').click();
		}
	});
});