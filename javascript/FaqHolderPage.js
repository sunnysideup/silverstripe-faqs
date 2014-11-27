/**
 *@author nicolaas[at]sunnysideup.co.nz
 *@description: hides the FAQ answers and displays them when you click on the question.
 **/

;(function($) {
	$(document).ready(function() {
		FaqHolderPage.init();
	});
})(jQuery);

var FaqHolderPage = {

	answersSelector: ".FaqAnswer",

	answersLinkSelector: ".FaqQuestion a",

	openQuestion: "faqOpenQuestion",

	closeQuestion: "faqClosedQuestion",

	init: function() {

		jQuery(FaqHolderPage.answersLinkSelector).on(
			"click",
			function(event) {
				event.preventDefault();
				var question = jQuery(this);
				var parent = jQuery(this).parents("li");
				var answer = parent.find(FaqHolderPage.answersSelector);
				question.toggleClass(FaqHolderPage.openQuestion);
				jQuery(parent.find(".FaqQuestion")).toggleClass(FaqHolderPage.openQuestion);
				answer.toggleClass(FaqHolderPage.closeQuestion).slideToggle();
			}
		);
	}
}
//as soon as possible

jQuery(FaqHolderPage.answersSelector).addClass(FaqHolderPage.closeQuestion);
jQuery(FaqHolderPage.answersLinkSelector).addClass(FaqHolderPage.closeQuestion);
