<?php

namespace Sunnysideup\Faqs;

use PageController;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\Requirements;

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
        $stage = '';
        if ('Live' === Versioned::get_stage()) {
            $stage = '_Live';
        }

        $className = $this->dataRecord->getEntryName();

        return $className::get()
            ->filter(['ParentID' => $array, 'ShowInSearch' => 1])
            ->leftJoin('SiteTree' . $stage, 'SiteTree' . $stage . '.ParentID = MyParent.ID', 'MyParent')
            ->leftJoin('SiteTree' . $stage, 'MyParent.ParentID = MyGrandParent.ID', 'MyGrandParent')
            ->leftJoin('SiteTree' . $stage, 'MyGrandParent.ParentID = MyGreatGrandParent.ID', 'MyGreatGrandParent')
            ->leftJoin('SiteTree' . $stage, 'MyGreatGrandParent.ParentID = MyGreatGreatGrandParent.ID', 'MyGreatGreatGrandParent')
            ->sort(
                '
                MyGreatGreatGrandParent.Sort,
                MyGreatGrandParent.Sort,
                MyGrandParent.Sort,
                MyParent.Sort,
                SiteTree' . $stage . '.Sort'
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
        Requirements::javascript('silverstripe/admin: thirdparty/jquery/jquery.js');
        Requirements::javascript('sunnysideup/faqs: client/javascript/FaqHolderPage.js');
        Requirements::themedCSS('client/css/FaqHolderPage');
    }
}
