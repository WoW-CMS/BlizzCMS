# _BlizzCMS Plus_

[![Project Status](https://img.shields.io/badge/Status-In_Development-yellow.svg?style=flat-square)](#)
[![Project Version](https://img.shields.io/badge/Version-1.0.7-green.svg?style=flat-square)](#)
[![PHP Composer Master](https://github.com/WoW-CMS/BlizzCMS/actions/workflows/php.yml/badge.svg?branch=master&event=push)](https://github.com/WoW-CMS/BlizzCMS/actions/workflows/php.yml)
[![Discord](https://img.shields.io/discord/217589275766685707.svg)](https://discord.com/invite/QXhHZpbeu5 "Our community hub on Discord")

![blizzcms_plus](https://user-images.githubusercontent.com/2810187/138610672-c936818d-5b87-4f1f-800d-2741384879ae.png)

**BlizzCMS plus**, is the improved version of **BlizzCMS v1** (which is an abandoned project). It is currently developed by the WOW-CMS community, and by independent contributors who make improvements to the code on a voluntary basis. It is currently **Open Source**, so everyone can study and improve the code, and it would be interesting that if you make improvements to it, you can share them with the community through a pull request.

## Useful Links

* [Website](https://wow-cms.com)
* [Docs](https://docs.wow-cms.com)
* [Donations](https://ko-fi.com/wowcms)

## Modules

- [x] admin
- [x] bugtracker
- [x] changelogs
- [x] donate
- [x] download
- [x] forum
- [x] home
- [x] mod
- [x] news
- [x] online
- [x] page
- [x] pvp
- [x] store
- [x] update
- [x] user
- [x] vote

Although some of them are still under constant development and maintenance/improvements. This ensures that we are always trying to improve the code that is currently developed or that can be incorporated.

## Requirements

#### PHP

- **7.1 or newer** is recommended (Version 8.x is currently supported.)

#### Apache Modules

- [mod_headers](https://httpd.apache.org/docs/2.4/mod/mod_headers.html)
- [mod_rewrite](https://httpd.apache.org/docs/2.4/mod/mod_rewrite.html)
- [mod_expires](https://httpd.apache.org/docs/2.4/mod/mod_expires.html)

#### PHP Extensions

- [curl](https://www.php.net/manual/en/book.curl.php)
- [gd](https://www.php.net/manual/en/book.image.php)
- [mbstring](https://www.php.net/manual/en/mbstring.installation.php)
- [mysqli](https://www.php.net/manual/en/book.mysqli.php)
- [openssl](https://www.php.net/manual/en/book.openssl.php)
- [soap](https://www.php.net/manual/en/class.soapclient.php)
- [gmp](https://www.php.net/manual/en/book.gmp.php)

## Some configurations

#### In linux (Apache Modules)

You can use the following command to enable the apache extensions mentioned above.

```sh
a2enmod headers
a2enmod rewrite
a2enmod expires
```

#### Edit Sites Available

/etc/apache2/sites-available/000-default.conf

For the mod_rewrite to work correctly and generate friendly URLs, it is necessary to have permissions on the directory where the CMS is located, commonly, located in `/var/www/html`.

```
<Directory "/var/www/html">
    AllowOverride All
</Directory>
```

#### Restarting the service

```sh
/etc/init.d/apache2 restart
```

### Docker Alternative
```sh
git clone https://github.com/WoW-CMS/BlizzCMS.git
cd BlizzCMS
docker-compose build
docker-compose up -d
```

## Active Developers

* [Darthar - Back/Front-End Developer](https://github.com/perioner)
* [DZywolf - Back/Front-End Developer](https://github.com/DZywolf)

## Inactive Developers
* @vipo - *Back-End Developer*

## Copyright

Copyright © 2017+ [WoW-CMS](https://wow-cms.com).
