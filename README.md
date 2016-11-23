#### Installation Guide

1. Upload the folder `IP2Location` to Magento installation directory `/app/code`.

2. Run command line and navigate to Magento installation directory.

3. Enable IP2Location CountryStateBlocker extension by following commands,

   ```
   php -q bin/magento cache:disable
   php -q bin/magento module:enable --clear-static-content IP2Location_CountryStateBlocker
   php -q bin/magento setup:upgrade
   ```

4. Login as administrator and navigate to Store > Configuration > IP2Location Country-State Blocker > Settings.

5. Configure the correct database path and API key.