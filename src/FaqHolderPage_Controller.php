<?php

namespace Sunnysideup\Faqs;

use PageController;


use SilverStripe\View\Requirements;
use SilverStripe\Versioned\Versioned;
use SilverStripe\CMS\Model\SiteTree;




/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: _Controller extends Page_Controller (case sensitive)
  * NEW: Controller extends PageController (COMPLEX)
  * EXP: Remove the underscores in your classname - check all references!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
class FaqHolderPageController extends PageController
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD:     public function init() (ignore case)
  * NEW:     protected function init() (COMPLEX)
  * EXP: Controller init functions are now protected  please check that is a controller.
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    protected function init()
    {
        parent::init();

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: THIRDPARTY_DIR."/jquery/jquery.js" (case sensitive)
  * NEW: 'silverstripe/admin: thirdparty/jquery/jquery.js' (COMPLEX)
  * EXP: Check for best usage and inclusion of Jquery
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        Requirements::javascript('sunnysideup/faqs: silverstripe/admin: thirdparty/jquery/jquery.js');
        Requirements::javascript("sunnysideup/faqs: faqs/javascript/FaqHolderPage.js");
        Requirements::themedCSS("sunnysideup/faqs: FaqHolderPage", "faqs");
    }

    /**
     * returns all underlying FaqOnePage pages...
     * for use in templates
     * @return DataList | Null
     */
    public function Entries()
    {
        $array = array($this->ID => $this->ID);
        if ($childGroups = $this->ChildGroups(4)) {
            if ($childGroups->count()) {
                foreach ($childGroups->map("ID", "ID") as $id) {
                    $array[$id] = $id;
                }
            }
        }
        $stage = '';
        if (Versioned::current_stage() == "Live") {
            $stage = "_Live";
        }

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $className (case sensitive)
  * NEW: $className (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        $className = $this->dataRecord->getEntryName();

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $className (case sensitive)
  * NEW: $className (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        return $className::get()
            ->filter(array("ParentID" => $array, "ShowInSearch" => 1))
            ->leftJoin(SiteTree::class.$stage, SiteTree::class.$stage.".ParentID = MyParent.ID", "MyParent")
            ->leftJoin(SiteTree::class.$stage, "MyParent.ParentID = MyGrandParent.ID", "MyGrandParent")
            ->leftJoin(SiteTree::class.$stage, "MyGrandParent.ParentID = MyGreatGrandParent.ID", "MyGreatGrandParent")
            ->leftJoin(SiteTree::class.$stage, "MyGreatGrandParent.ParentID = MyGreatGreatGrandParent.ID", "MyGreatGreatGrandParent")
            ->sort(
                "
                MyGreatGreatGrandParent.Sort,
                MyGreatGrandParent.Sort,
                MyGrandParent.Sort,
                MyParent.Sort,
                SiteTree".$stage.".Sort"
            );
    }

    public function MyParentHolder()
    {

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $className (case sensitive)
  * NEW: $className (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        $className = $this->dataRecord->getHolderPage();

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $className (case sensitive)
  * NEW: $className (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        return $className::get()->byID($this->ParentID);
    }
}
