<?php

namespace Sunnysideup\Faqs;

use Page;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;

/**
 * Class \Sunnysideup\Faqs\FaqOnePage
 *
 */
class FaqOnePage extends Page
{
    private static $table_name = 'FaqOnePage';

    private static $icon = 'sunnysideup/faqs: client/images/FaqOnePage-file.png';

    private static $description = 'Individual FAQ Page, displays the answer to one question';

    private static $default_parent = FaqHolderPage::class;

    private static $can_be_root = false;

    private static $allowed_children = 'none';

    private static $defaults = [
        'ShowInMenus' => 0,
    ];

    /**
     * Standard SS variable.
     */
    private static $singular_name = 'FAQ Page';

    /**
     * Standard SS variable.
     */
    private static $plural_name = 'FAQ Pages';

    public function i18n_singular_name()
    {
        return _t('FAQPage.SINGULARNAME', 'FAQ Page');
    }

    public function i18n_plural_name()
    {
        return _t('FAQPage.PLURALNAME', 'FAQ Pages');
    }

    //private static $has_many = array();

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->replaceField('Title', new TextField('Title', 'Question'));
        $fields->replaceField('MenuTitle', new TextField('MenuTitle', 'Question - short version for menus'));
        $fields->replaceField('Content', new HTMLEditorField('Content', 'Answer'));

        return $fields;
    }
}
