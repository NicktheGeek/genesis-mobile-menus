jQuery(document).ready(function($) {
    // $() will work as an alias for jQuery() inside of this function
	
	$("#gmm-menu-toggle .show").click(function () {
		if ($(".gmm-collapse-menu").is(":hidden")) {
			$(".gmm-collapse-menu").slideDown(500);
			$(this).attr('class', 'toggle-switch hide').attr('title', 'Hide Menu');
			$('#gmm-menu-toggle span').replaceWith('<span>Hide Menu</span>');
		} else {
			$(".gmm-collapse-menu").hide(500);
			$(this).attr('class', 'toggle-switch show').attr('title', 'Show Menu');
			$('#gmm-menu-toggle span').replaceWith('<span>Show Menu</span>');
		}
	});
	
	
});