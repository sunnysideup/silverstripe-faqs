<?php

/**
 *@author nicolaas[at]sunnysideup.co.nz
 *@description: holds FAQs and displays them nicely.
 *
 */
class FaqHolderPage extends Page
{

    private static $icon = "mysite/images/treeicons/FaqHolderPage";

    private static $description =  "A list of Frequently Asked Questions" ;

    //private static $default_parent = '';

    private static $default_child = 'FaqOnePage';

    private static $allowed_children = array('FaqHolderPage', 'FaqOnePage');

    /**
     * Standard SS variable.
     */
    private static $singular_name = "FAQ Holder Page";
    public function i18n_singular_name()
    {
        return _t("FAQHolderPage.SINGULARNAME", "FAQ Holder Page");
    }

    /**
     * Standard SS variable.
     */
    private static $plural_name = "FAQ Holder Pages";
    public function i18n_plural_name()
    {
        return _t("FAQHolderPage.PLURALNAME", "FAQ Holder Pages");
    }

    /**
     * The holder page class in use.
     * You can extends this Class and change this value.
     * @var String
     */
    protected $holderPage = "FAQHolderPage";

    /**
     * The item page class in use.
     * You can extends this Class and change this value.
     * @var String
     */
    protected $entryPage = "FAQOnePage";

    /**
     * Returns children FAQHolderPage pages of this FAQHolderPage.
     *
     * @param Int $maxRecursiveLevel - maximum depth , e.g. 1 = one level down - so no Child Groups are returned...
     * @param Int $numberOfRecursions - current level of depth. DONT provide this variable...
     * @return ArrayList (FAQHolderPages)
     */
    public function ChildGroups($maxRecursiveLevel = 99, $numberOfRecursions = 0)
    {
        $arrayList = ArrayList::create();
        if ($numberOfRecursions < $maxRecursiveLevel) {
            $className = $this->getHolderPage();
            $children = $className::get()->filter(array("ParentID" => $this->ID));
            if ($children->count()) {
                foreach ($children as $child) {
                    $arrayList->push($child);
                    $arrayList->merge($child->ChildGroups($maxRecursiveLevel, $numberOfRecursions++));
                }
            }
        }
        if (!$arrayList instanceof ArrayList) {
            user_error("We expect an array list as output");
        }
        return $arrayList;
    }

    /**
     * sets the classname for pages that are holder pages
     * @param String $name
     */
    public function setHolderPage($name)
    {
        $this->holderPage = $name;
    }

    /**
     * gets the classname for pages that are holder pages
     * @return String
     */
    public function getHolderPage()
    {
        return $this->holderPage;
    }

    /**
     * sets the classname for pages that are individual items
     * @param String $name
     */
    public function setEntryName($name)
    {
        $this->entryPage;
    }

    /**
     * gets the classname for pages that are individual items
     * @return String
     */
    public function getEntryName()
    {
        return $this->entryPage;
    }
}

class FaqHolderPage_Controller extends Page_Controller
{



    public function init()
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
                $array += $childGroups->map("ID", "ID");
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
            ->sort("MyGreatGreatGrandParent.Sort ASC, MyGreatGrandParent.Sort ASC, MyGrandParent.Sort ASC, MyParent.Sort ASC, SiteTree".$stage.".Sort ASC");
    }
}
