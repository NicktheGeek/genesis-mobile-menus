jQuery(document).ready(function($) {
    // $() will work as an alias for jQuery() inside of this function
	
	$("#gmm-menu-toggle .show").click(function () {
		if ($(".gmm-collapse-menu").is(":hidden")) {
			$(".gmm-collapse-menu").slideDown(500);
			$(this).attr('class', 'toggle-switch hide').attr('title', gmm_text.hide_text );
			$('#gmm-menu-toggle span').html( gmm_text.hide_text );
		} else {
			$(".gmm-collapse-menu").hide(500);
			$(this).attr('class', 'toggle-switch show').attr('title', gmm_text.show_text );
			$('#gmm-menu-toggle span').html( gmm_text.show_text );
		}
	});
	
	
});