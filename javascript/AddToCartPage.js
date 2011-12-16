
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
		jQuery(".moreInformation a").click(
			function() {
				var url = jQuery(this).attr("href");
				var domElement = jQuery(this).attr("rel");
				jQuery.get(
					url,
					function(html) {
						jQuery(domElement).html(data);
					}
				);
			}
		);
	}



}
