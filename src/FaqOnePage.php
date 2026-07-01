<?php

declare(strict_types=1);

namespace Sunnysideup\Faqs;

use Override;
use Page;

/**
 * Class \Sunnysideup\Faqs\FaqOnePage
 *
 */
class FaqOnePage extends Page
{
    private static $table_name = 'FaqOnePage';

    private static $cms_icon = 'sunnysideup/faqs: client/images/FaqOnePage-file.png';

    private static $class_description = 'Individual FAQ Page, displays the answer to one question';

    private static $default_parent = FaqHolderPage::class;

    private static $can_be_root = false;

    private static $allowed_children = 'none';

    private static $defaults = [
        'ShowInMenus' => 0,
    ];

    private static $db = [
        'MoreDetails' => 'HTMLText',
    ];

    /**
     * Standard SS variable.
     */
    private static $singular_name = 'FAQ Page';

    /**
     * Standard SS variable.
     */
    private static $plural_name = 'FAQ Pages';

    #[Override]
    public function i18n_singular_name()
    {
        return _t('FAQPage.SINGULARNAME', 'FAQ Page');
    }

    #[Override]
    public function plural_name()
    {
        return _t('FAQPage.PLURALNAME', 'FAQ Pages');
    }

    //private static $has_many = array();

    #[Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->dataFieldByName('Title')->setTitle('Question');
        $fields->dataFieldByName('MenuTitle')->setTitle('Question - short version for menus');
        $fields->dataFieldByName('Content')->setTitle('Answer');
        $fields->dataFieldByName('MoreDetails')->setTitle('Additional Details');

        return $fields;
    }
}
