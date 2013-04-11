jQuery(document).ready(function($) {
	$("select.gmm-mobile-select").change(function() {
		window.location = $(this).find("option:selected").val();  
	});
})