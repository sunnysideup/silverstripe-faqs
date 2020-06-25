<?php
/**
 *@author nicolaas[at] sunnysideup.co.nz
 *@description: individual FAQ page. Usually, these are not viewed as they can be read completely from the parent (FAQ HOLDER) page.
 */
class FaqOnePage extends Page
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: app/images/ (case sensitive)
  * NEW: app: images/ (COMPLEX)
  * EXP: check for location
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    private static $icon = "app: images/treeicons/FaqOnePage";

    private static $description = "Individual FAQ Page, displays the answer to one question";

    private static $default_parent = 'FaqHolderPage';

    private static $can_be_root = false;

    private static $allowed_children = "none";

    private static $defaults = array(
        'ShowInMenus' => 0
    );

    private static $has_one = [];

    /**
     * Standard SS variable.
     */
    private static $singular_name = "FAQ Page";
    public function i18n_singular_name()
    {
        return _t("FAQPage.SINGULARNAME", "FAQ Page");
    }

    /**
     * Standard SS variable.
     */
    private static $plural_name = "FAQ Pages";
    public function i18n_plural_name()
    {
        return _t("FAQPage.PLURALNAME", "FAQ Pages");
    }

    //private static $has_many = array();

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->replaceField("Title", new TextField("Title", "Question"));
        $fields->replaceField("MenuTitle", new TextField("MenuTitle", "Question - short version for menus"));
        $fields->replaceField("Content", new HTMLEditorField("Content", "Answer"));
        return $fields;
    }
}

