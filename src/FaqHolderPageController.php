<?php

namespace Sunnysideup\Faqs;

use Override;
use SilverStripe\ORM\DataList;
use PageController;
use SilverStripe\View\Requirements;

/**
 * Class \Sunnysideup\Faqs\FaqHolderPageController
 *
 * @property FaqHolderPage $dataRecord
 * @method FaqHolderPage data()
 * @mixin FaqHolderPage
 */
class FaqHolderPageController extends PageController
{
    /**
     * returns all underlying FaqOnePage pages...
     * for use in templates.
     *
     * @return null|DataList
     */
    public function Entries() {}

    public function MyParentHolder()
    {
        $className = $this->dataRecord->getHolderPage();

        return $className::get_by_id($this->ParentID);
    }

    #[Override]
    protected function init()
    {
        parent::init();
        Requirements::javascript('https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js');
        Requirements::javascript('sunnysideup/faqs: client/javascript/FaqHolderPage.js');
        Requirements::themedCSS('client/css/FaqHolderPage');
    }
}
