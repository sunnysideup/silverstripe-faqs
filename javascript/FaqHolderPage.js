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

	questionSelector: ".FaqQuestion",

	questionLinkSelector: ".FaqQuestion a",

	answersSelector: ".FaqAnswer",

	openQuestion: "faqOpenQuestion",

	closedQuestion: "faqClosedQuestion",

	init: function() {

		jQuery(FaqHolderPage.questionLinkSelector).on(
			"click",
			function(event) {
				event.preventDefault();
				var question = jQuery(this);
				var parent = jQuery(this).parents("li");
				var answer = parent.find(FaqHolderPage.answersSelector);
				if(parent.hasClass(FaqHolderPage.openQuestion)) {
					parent.removeClass(FaqHolderPage.openQuestion).addClass(FaqHolderPage.closedQuestion);
					//question.removeClass(FaqHolderPage.openQuestion).addClass(FaqHolderPage.closedQuestion);
					//answer.removeClass(FaqHolderPage.openQuestion).addClass(FaqHolderPage.closedQuestion).slideUp();
					answer.slideUp();
				}
				else {
					var siblings = parent.siblings("li."+FaqHolderPage.openQuestion);
					jQuery(siblings).each(
						function(i, siblingParent) {
							//remove class from parent
							jQuery(siblingParent).removeClass(FaqHolderPage.openQuestion).addClass(FaqHolderPage.closedQuestion);
							// close other questions
							//jQuery(siblingParent).find(FaqHolderPage.questionLinkSelector).removeClass(FaqHolderPage.openQuestion).addClass(FaqHolderPage.closedQuestion);
							//close other answers
							//jQuery(siblingParent).find(FaqHolderPage.answersSelector).removeClass(FaqHolderPage.openQuestion).addClass(FaqHolderPage.closedQuestion).slideUp();
							jQuery(siblingParent).find(FaqHolderPage.answersSelector).slideUp();
						}
					);
					parent.removeClass(FaqHolderPage.closedQuestion).addClass(FaqHolderPage.openQuestion);
					//question.removeClass(FaqHolderPage.closedQuestion).addClass(FaqHolderPage.openQuestion);
					//answer.removeClass(FaqHolderPage.closedQuestion).addClass(FaqHolderPage.openQuestion).slideDown();
					answer.slideDown();
				}
			}
		);
	}
}

//as soon as possible
jQuery(FaqHolderPage.questionSelector).addClass(FaqHolderPage.closeQuestion);
