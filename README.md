This plugin enable Magento users to easily redirect or block visitors based on their geo location. Below are the key features of this plugin

* Redirect or block visitors by country
* Redirect or block visitors by state/region
* Support multiple rules for blocking/redirection
* Flexible way to define your source URLs for blocking/redirection, i.e., exact match or regular expression.

This plugin support the use of [IP2Location Free LITE BIN database](http://lite.ip2location.com) or [IP2Location web service](http://www.ip2location.com/web-service) for geolocation lookup.

* IP2Location LITE BIN download path: http://lite.ip2location.com
* IP2Location web service registration path: http://www.ip2location.com/web-service

## Installation Guide

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

