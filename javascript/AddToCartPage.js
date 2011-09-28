
jQuery(document).ready(
	function(){
		AddToCartPage.init();
	}
);


var AddToCartPage = {

	init: function(){
		jQuery(".ULgroups, .ULproducts, div.productActionsOuter").hide();
		jQuery(".ULgroups a.groupLink, .ULproducts a.productLink").click(
			function(event) {
				event.preventDefault();
				jQuery(this).next("ul, div.productActionsOuter").slideToggle();
			}
		);
		jQuery("UL.level1").slideDown();
	}



}
