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
    public function Entries() {}

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
