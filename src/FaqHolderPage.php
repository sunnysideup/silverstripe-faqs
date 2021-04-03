<?php

namespace Sunnysideup\Faqs;

use Page;

use SilverStripe\ORM\ArrayList;

/**
 *@author nicolaas[at]sunnysideup.co.nz
 *@description: holds FAQs and displays them nicely.
 */
class FaqHolderPage extends Page
{
    /**
     * The holder page class in use.
     * You can extends this Class and change this value.
     * @var string
     */
    protected $holderPage = FaqHolderPage::class;

    /**
     * The item page class in use.
     * You can extends this Class and change this value.
     * @var string
     */
    protected $entryPage = FaqOnePage::class;

    private static $table_name = 'FaqHolderPage';

    private static $icon = 'sunnysideup/faqs: client/images/FaqHolderPage-file.png';

    private static $description = 'A list of Frequently Asked Questions';

    //private static $default_parent = '';

    private static $default_child = FaqOnePage::class;

    private static $allowed_children = [FaqHolderPage::class, FaqOnePage::class];

    /**
     * Standard SS variable.
     */
    private static $singular_name = 'FAQ Holder Page';

    /**
     * Standard SS variable.
     */
    private static $plural_name = 'FAQ Holder Pages';

    public function i18n_singular_name()
    {
        return _t('FaqHolderPage.SINGULARNAME', 'FAQ Holder Page');
    }

    public function i18n_plural_name()
    {
        return _t('FaqHolderPage.PLURALNAME', 'FAQ Holder Pages');
    }

    /**
     * Returns children FaqHolderPage pages of this FaqHolderPage.
     * @return ArrayList (FaqHolderPages)
     */
    public function ChildGroups(?int $maxRecursiveLevel = 99, ?int $numberOfRecursions = 0, $filter = null): ArrayList
    {
        $arrayList = ArrayList::create();
        if ($numberOfRecursions < $maxRecursiveLevel) {
            $className = $this->getHolderPage();
            $children = $className::get()->filter(['ParentID' => $this->ID]);
            if (! empty($filter)) {
                $children = $children->filter($filter);
            }
            if ($children->count()) {
                foreach ($children as $child) {
                    $arrayList->push($child);
                    ++$numberOfRecursions;
                    $arrayList->merge($child->ChildGroups($maxRecursiveLevel, $numberOfRecursions, $filter));
                }
            }
        }

        return $arrayList;
    }

    /**
     * sets the classname for pages that are holder pages
     * @param string $name
     */
    public function setHolderPage($name)
    {
        $this->holderPage = $name;
    }

    /**
     * gets the classname for pages that are holder pages
     * @return string
     */
    public function getHolderPage()
    {
        return $this->holderPage;
    }

    /**
     * sets the classname for pages that are individual items
     * @param string $name
     */
    public function setEntryName($name)
    {
        $this->entryPage;
    }

    /**
     * gets the classname for pages that are individual items
     * @return string
     */
    public function getEntryName()
    {
        return $this->entryPage;
    }
}
