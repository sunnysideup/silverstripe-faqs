/**
 *@author nicolaas[at]sunnysideup.co.nz
 *@description: hides the FAQ answers and displays them when you click on the question.
 **/

;(function($) {
	$(document).ready(function() {
		FaqHolderPage.init();
	});

	var FaqHolderPage = {

		answersSelector: ".FaqAnswer",

		answersLinkSelector: ".FaqQuestion a",

		seperator: "-",

		answerIDPrefix: "answer",

		openQuestion: "faqOpenQuestion",

		init: function() {
			jQuery(FaqHolderPage.answersSelector).hide();
			jQuery(FaqHolderPage.answersLinkSelector).click(
				function() {
					var parent = jQuery(this).parent();
					var parentID = jQuery(parent).attr("id");
					var parentID = jQuery(parent).attr("id");
					var parentIDArray = parentID.split(FaqHolderPage.seperator);
					if(parentIDArray) {
						if(parentIDArray.length > 1) {
							var parentURLSegment = '';
							for(var i = 1; i < parentIDArray.length; i++) {
								parentURLSegment += FaqHolderPage.seperator + parentIDArray[i];
							}
							if(parentURLSegment) {
								var answerSelector = "#"+FaqHolderPage.answerIDPrefix + parentURLSegment;
								//debug: alert(answerSelector)
								if(jQuery(answerSelector).is(':visible')) {
									jQuery(answerSelector).slideUp(
										function() {
											jQuery(parent).parent().removeClass(FaqHolderPage.openQuestion);
										}
									);
									//jQuery(parent).parent().removeClass(FaqHolderPage.openQuestion);
								}
								else {
									jQuery(answerSelector).slideDown(
										function() {
											jQuery(parent).parent().addClass(FaqHolderPage.openQuestion);
										}
									);

								}
								return false;
							}
						}
					}
				}
			);
		}
	}
})(jQuery);