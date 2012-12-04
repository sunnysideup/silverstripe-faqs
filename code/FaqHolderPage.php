<?php

/**
 *@author nicolaas[at]sunnysideup.co.nz
 *@description: holds FAQs and displays them nicely.
 *
 */
class FaqHolderPage extends Page {

	static $icon = "mysite/images/treeicons/FaqHolderPage";

	//static $default_parent = '';

	static $default_child = 'FaqOnePage';

	static $allowed_children = array('FaqOnePage');

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
		return DataObject::get("FaqOnePage", "ShowInMenus = 1 AND ParentID = ".$this->ID);
	}

}

