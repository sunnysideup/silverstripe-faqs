<?php

/**
 *@author nicolaas[at]sunnysideup.co.nz
 *@description: holds FAQs and displays them nicely.
 *
 */
class FaqHolderPage extends Page {

	private static $icon = "mysite/images/treeicons/FaqHolderPage";

	private static $description =  "A list of Frequently Asked Questions" ;

	//private static $default_parent = '';

	private static $default_child = 'FaqOnePage';

	private static $allowed_children = array('FaqOnePage');

	/**
	 * Standard SS variable.
	 */
	private static $singular_name = "FAQ Holder Page";
		function i18n_singular_name() { return _t("FAQHolderPage.SINGULARNAME", "FAQ Holder Page");}

	/**
	 * Standard SS variable.
	 */
	private static $plural_name = "FAQ Holder Pages";
		function i18n_plural_name() { return _t("FAQHolderPage.PLURALNAME", "FAQ Holder Pages");}

	function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}

}

class FaqHolderPage_Controller extends Page_Controller {



	function init() {
		parent::init();
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript("faqs/javascript/FaqHolderPage.js");
		Requirements::themedCSS("FaqHolderPage");
	}

	function FAQs() {
		return FaqOnePage::get()
			->filter(
				array(
					"ShowInMenus" => 1,
					"ParentID" => $this->ID
				)
			);
	}

}

