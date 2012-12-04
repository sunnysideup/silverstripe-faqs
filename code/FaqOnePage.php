<?php
/**
 *@author nicolaas[at] sunnysideup.co.nz
 *@description: individual FAQ page. Usually, these are not viewed as they can be read completely from the parent (FAQ HOLDER) page.
 */
class FaqOnePage extends Page {

	static $icon = "mysite/images/treeicons/FaqOnePage";

	static $default_parent = 'FaqHolderPage';

	static $allowed_children = "none";

	static $db = array();

	static $has_one = array();


	//static $has_many = array();

	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->replaceField("Title", new TextField("Title", "Question"));
		$fields->replaceField("MenuTitle", new TextField("MenuTitle", "Question - short version for menus"));
		$fields->replaceField("Content", new HtmlEditorField("Content", "Answer", $rows = 7, $cols = 7));
		return $fields;
	}

}

class FaqOnePage_Controller extends Page_Controller {



	function init() {
		parent::init();
	}



}

