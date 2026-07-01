# Silverstripe CMS v6 Upgrade Guide

This document outlines the necessary steps and breaking changes required to upgrade your project to support Silverstripe CMS v6.

## 🚨 CRITICAL REVIEW REQUIRED / RISKY

**The `#[Override]` attribute has been added to several methods in this upgrade. This PHP 8 feature enforces that the method is overriding a parent method. If your project has custom subclasses that override these same methods without matching the new signature from the parent, it will cause fatal errors.**

**You must carefully review any custom classes extending `FaqHolderPage`, `FaqHolderPageController`, and `FaqOnePage` to ensure method signatures are compatible.**

---

## ⚠️ BREAKING CHANGES

### Configuration

*   **Database Administration:** The deprecated `SilverStripe\ORM\DatabaseAdmin` class has been removed. You must update your configuration files (e.g., `_config/database.legacy.yml`) to use `SilverStripe\Dev\DbBuild` for any class name remapping or similar configurations.

### Core Requirements

*   **Silverstripe Version:** The core dependency `silverstripe/recipe-cms` has been updated to `^6.0`. This requires a full environment and dependency upgrade to be compatible with Silverstripe CMS 6.

### API Changes

*   **Page Icons:** The static property for defining CMS icons has changed from `$icon` to `$cms_icon`. Update your `FaqHolderPage` and `FaqOnePage` subclasses accordingly.
*   **Page Descriptions:** The static property for class descriptions has changed from `$description` to `$class_description`. Update your `FaqHolderPage` and `FaqOnePage` subclasses.
*   **Form Fields:** In `FaqOnePage::getCMSFields()`, field replacement logic using `replaceField` has been updated to the more direct `dataFieldByName()->setTitle()` method. If you have extended this method, ensure your logic is compatible with the new approach.

### PHP Requirements

*   **`#[Override]` Attribute:** The `#[Override]` attribute is now used on methods like `i18n_singular_name`, `plural_name`, `init`, and `getCMSFields`. This enforces stricter method overriding from parent classes, a feature of PHP 8.
