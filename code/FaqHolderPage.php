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
			/*
### @@@@ UPGRADE REQUIRED @@@@ ###
FIND: ->filter(
NOTE: ArrayList filter method no longer modifies current list; only returns a new version.
### @@@@ ########### @@@@ ###
*/->filter(
				array(
					"ShowInMenus" => 1,
					"ParentID" => $this->ID
				)
			);
	}

}

