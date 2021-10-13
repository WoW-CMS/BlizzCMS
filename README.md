# _BlizzCMS Plus_
**_BlizzCMS Plus_** is a restructured and improved version of BlizzCMS **v1**. The development of this version is made constantly by the developers of **WoW-CMS** in closed source taking into consideration that it is necessary to obtain a **license** for a public use.

[![Project Status](https://img.shields.io/badge/Status-In_Development-yellow.svg?style=flat-square)](#)
[![Project Version](https://img.shields.io/badge/Version-1.0.7-green.svg?style=flat-square)](#)
[![Discord](https://img.shields.io/discord/217589275766685707.svg)](https://discord.com/invite/QXhHZpbeu5 "Our community hub on Discord")
[![Donations](https://www.vectorlogo.zone/logos/ko-fi/ko-fi-ar21.svg)](https://ko-fi.com/wowcms)

| Requirements | Description |
| :----------- | :---------- |
| **PHP Version** | **7.1 or newer** is recommended (Version 8.x is currently not supported.) |
| **Apache Modules** | mod_headers - mod_rewrite - mod_expires |
| **PHP Extensions** | curl - gd2 - mbstring - mysqli - openssl - soap - gmp |

## Useful Links

* [Website](https://wow-cms.com)
* [Docs](https://docs.wow-cms.com)

## In linux (Apache Modules)

```sh
a2enmod headers
a2enmod rewrite
a2enmod expires
```

### Edit Sites Available
/etc/apache2/sites-available/000-default.conf

```
<Directory "/var/www/html">
	AllowOverride All
</Directory>
```

### Restarting the service

```sh
/etc/init.d/apache2 restart or service apache2 restart
```

## Active Developers

* @perioner - *Back/Front-End Developer*
* @DZywolf - *Back/Front-End Developer*

## Inactive Developers
* @vipo - *Back-End Developer*

## Copyright

Copyright © 2021 [WoW-CMS](https://wow-cms.com).
