<?php

class FaqHolderPage_Controller extends Page_Controller
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
        Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
        Requirements::javascript("faqs/javascript/FaqHolderPage.js");
        Requirements::themedCSS("FaqHolderPage", "faqs");
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
        $className = $this->dataRecord->getEntryName();
        return $className::get()
            ->filter(array("ParentID" => $array, "ShowInSearch" => 1))
            ->leftJoin("SiteTree".$stage, "SiteTree".$stage.".ParentID = MyParent.ID", "MyParent")
            ->leftJoin("SiteTree".$stage, "MyParent.ParentID = MyGrandParent.ID", "MyGrandParent")
            ->leftJoin("SiteTree".$stage, "MyGrandParent.ParentID = MyGreatGrandParent.ID", "MyGreatGrandParent")
            ->leftJoin("SiteTree".$stage, "MyGreatGrandParent.ParentID = MyGreatGreatGrandParent.ID", "MyGreatGreatGrandParent")
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
        $className = $this->dataRecord->getHolderPage();
        return $className::get()->byID($this->ParentID);
    }
}
