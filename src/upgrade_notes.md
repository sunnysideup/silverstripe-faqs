2020-06-26 07:48

# running php upgrade inspect see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/faqs
php /var/www/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code inspect /var/www/upgrades/faqs/faqs/src  --root-dir=/var/www/upgrades/faqs --write -vvv
Writing changes for 1 files
Running post-upgrade on "/var/www/upgrades/faqs/faqs/src"
[2020-06-26 07:48:30] Applying ApiChangeWarningsRule to FaqHolderPage_Controller.php...
[2020-06-26 07:48:31] Applying UpdateVisibilityRule to FaqHolderPage_Controller.php...
[2020-06-26 07:48:31] Applying ApiChangeWarningsRule to FaqOnePage.php...
[2020-06-26 07:48:31] Applying UpdateVisibilityRule to FaqOnePage.php...
[2020-06-26 07:48:31] Applying ApiChangeWarningsRule to FaqHolderPage.php...
[2020-06-26 07:48:31] Applying UpdateVisibilityRule to FaqHolderPage.php...
[2020-06-26 07:48:31] Applying ApiChangeWarningsRule to FaqOnePage_Controller.php...
[2020-06-26 07:48:31] Applying UpdateVisibilityRule to FaqOnePage_Controller.php...
modified:	FaqHolderPage_Controller.php
@@ -63,7 +63,7 @@
             }
         }
         $stage = '';
-        if (Versioned::current_stage() == "Live") {
+        if (Versioned::get_stage() == "Live") {
             $stage = "_Live";
         }


Warnings for FaqHolderPage_Controller.php:
 - FaqHolderPage_Controller.php:66 SilverStripe\Versioned\Versioned::current_stage(): Moved to SilverStripe\Versioned\Versioned::get_stage()
Writing changes for 1 files
✔✔✔