
jQuery(document).ready(
	function(){
		EcomAddToCartPage.init();
	}
);


var EcomAddToCartPage = {

	loadingClass: "loading",
	formSelector: "#QuickAddToCartFormHolder form",
	actiomButtonSelector: "#QuickAddToCartFormHolder form .Actions input",
	responseSelector: ".selectedBuyable span",
	findBuyableFieldSelector: ".findBuyable input",

	init: function(){
		var options = {
			target:        EcomAddToCartPage.responseSelector,   // target element(s) to be updated with server response
			beforeSubmit:  EcomAddToCartPage.showRequest,  // pre-submit callback
			success:       EcomAddToCartPage.showResponse  // post-submit callback
			// other available options:
			//url:       url         // override for form's 'action' attribute
			//type:      type        // 'get' or 'post', override for form's 'method' attribute
			//dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
			//clearForm: true        // clear all form fields after successful submit
			//resetForm: true        // reset the form after successful submit
			// jQuery.ajax options can be used here too, for example:
			//timeout:   3000
		};
		// bind form using 'ajaxForm'
		jQuery(EcomAddToCartPage.formSelector).ajaxForm(options);
	},
	// pre-submit callback
	showRequest: function(formData, jqForm, options) {
		jQuery(EcomAddToCartPage.actiomButtonSelector).hide();

		// here we could return false to prevent the form from being submitted;
		// returning anything other than false will allow the form submit to continue
		return true;
	},

	// post-submit callback
	showResponse: function(responseText, statusText, xhr, jQueryform)  {
		jQuery(EcomAddToCartPage.actiomButtonSelector).show();
		jQuery(EcomAddToCartPage.responseSelector).html(responseText);
		jQuery(EcomAddToCartPage.findBuyableFieldSelector).focus();
		// for normal html responses, the first argument to the success callback
		// is the XMLHttpRequest object's responseText property

		// if the ajaxForm method was passed an Options Object with the dataType
		// property set to 'xml' then the first argument to the success callback
		// is the XMLHttpRequest object's responseXML property

		// if the ajaxForm method was passed an Options Object with the dataType
		// property set to 'json' then the first argument to the success callback
		// is the json data object returned by the server

	}
}
