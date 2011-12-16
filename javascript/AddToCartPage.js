
jQuery(document).ready(
	function(){
		AddToCartPage.init();
	}
);


var AddToCartPage = {

	loadingClass: "loading",

	completedClass: "completed",

	ulGroupsSelector: ".ULgroups, .ULproducts, div.productActionsOuter",

	expandLinkSelector: ".ULgroups a.groupLink, .ULproducts a.productLink",

	expandDivSelector: "ul, div.productActionsOuter",

	levelOneSelector: "UL.level1",

	moreInfoHolderSelector: ".moreInfoHolder",

	moreInfoLinkSelector: ".moreInformation a",

	init: function(){
		jQuery(AddToCartPage.ulGroupsSelector).hide();
		jQuery(AddToCartPage.expandLinkSelector).click(
			function(event) {
				event.preventDefault();
				jQuery(this).next(AddToCartPage.expandDivSelector).slideToggle();
			}
		);
		jQuery(AddToCartPage.levelOneSelector).slideDown();
		jQuery(AddToCartPage.moreInfoHolderSelector).hide();
		jQuery(AddToCartPage.moreInfoLinkSelector).click(
			function(event) {
				event.preventDefault();
				var parentElement = this;
				var domElement = "#" + jQuery(this).attr("rel");
				var url = jQuery(this).attr("href");
				if(jQuery(domElement).hasClass(AddToCartPage.completedClass)) {
					jQuery(domElement).slideToggle();
				}
				else {
					jQuery(parentElement).addClass(AddToCartPage.loading);
					jQuery.get(
						url,
						function(html) {
							jQuery(domElement).html(html).addClass(AddToCartPage.completedClass).slideDown();
							jQuery(parentElement).removeClass(AddToCartPage.loading);
						}
					);
				}
			}
		);
	}



}
