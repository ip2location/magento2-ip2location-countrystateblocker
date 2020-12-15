# IP2Location Country Blocker

This plugin enable Magento users to easily redirect or block visitors based on their geo location. Below are the key features of this plugin

* Redirect or block visitors by country
* Redirect or block visitors by state/region
* Support multiple rules for blocking/redirection
* Flexible way to define your source URLs for blocking/redirection, i.e., exact match or regular expression.

This plugin support the use of [IP2Location Free LITE BIN database](https://lite.ip2location.com) or [IP2Location web service](https://www.ip2location.com/web-service) for geolocation lookup.

* IP2Location LITE BIN download path: https://lite.ip2location.com
* IP2Location web service registration path: https://www.ip2location.com/web-service



## IPv4 BIN vs IPv6 BIN

Use the IPv4 BIN file if you just need to query IPv4 addresses.

Use the IPv6 BIN file if you need to query BOTH IPv4 and IPv6 addresses.



## Installation Guide

1. Under the Magento installation directory, please sub directory `app/code/Hexasoft/IP2LocationCountryBlocker`.

2. Upload the files in this repository to that directory.

3. Open terminal or command line then navigate to Magento installation directory.

4. Enable IP2Location Country Blocker extension by following commands,

   ```
   php -q bin/magento cache:disable
   php -q bin/magento module:enable --clear-static-content Hexasoft_IP2LocationCountryBlocker
   php -q bin/magento setup:upgrade
   php -q bin/magento cache:enable
   ```

5. Open your web browser, login to Magento as administrator and navigate to Store > Configuration > IP2Location Country Blocker > Settings.

6. Configure the correct database path and API key.
