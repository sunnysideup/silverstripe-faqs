<?php

namespace Sunnysideup\Faqs;

use PageController;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\Requirements;

/**
 * Class \Sunnysideup\Faqs\FaqHolderPageController
 *
 * @property \Sunnysideup\Faqs\FaqHolderPage $dataRecord
 * @method \Sunnysideup\Faqs\FaqHolderPage data()
 * @mixin \Sunnysideup\Faqs\FaqHolderPage
 */
class FaqHolderPageController extends PageController
{
    /**
     * returns all underlying FaqOnePage pages...
     * for use in templates.
     *
     * @return null|\SilverStripe\ORM\DataList
     */
    public function Entries()
    {
        $array = [$this->ID => $this->ID];
        $childGroups = $this->ChildGroups(4);
        if ($childGroups) {
            if ($childGroups->exists()) {
                foreach ($childGroups->map('ID', 'ID') as $id) {
                    $array[$id] = $id;
                }
            }
        }
        $singleton = DataObject::singleton(SiteTree::class);
        $siteTreeTableName = $singleton->stageTable($singleton->config()->table_name, Versioned::get_stage());

        $className = $this->dataRecord->getEntryName();

        return $className::get()
            ->filter(['ParentID' => $array, 'ShowInSearch' => 1])
            ->leftJoin('' . $siteTreeTableName, '' . $siteTreeTableName . '.ParentID = MyParent.ID', 'MyParent')
            ->leftJoin('' . $siteTreeTableName, 'MyParent.ParentID = MyGrandParent.ID', 'MyGrandParent')
            ->leftJoin('' . $siteTreeTableName, 'MyGrandParent.ParentID = MyGreatGrandParent.ID', 'MyGreatGrandParent')
            ->leftJoin('' . $siteTreeTableName, 'MyGreatGrandParent.ParentID = MyGreatGreatGrandParent.ID', 'MyGreatGreatGrandParent')
            ->sort(
                '
                MyGreatGreatGrandParent.Sort,
                MyGreatGrandParent.Sort,
                MyGrandParent.Sort,
                MyParent.Sort,
                SiteTree' . $siteTreeTableName . '.Sort'
            )
        ;
    }

    public function MyParentHolder()
    {
        $className = $this->dataRecord->getHolderPage();

        return $className::get_by_id($this->ParentID);
    }

    protected function init()
    {
        parent::init();
        Requirements::javascript('https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js');
        Requirements::javascript('sunnysideup/faqs: client/javascript/FaqHolderPage.js');
        Requirements::themedCSS('client/css/FaqHolderPage');
    }
}
