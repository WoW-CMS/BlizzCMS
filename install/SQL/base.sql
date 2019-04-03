/*
SQLyog Ultimate v13.1.2 (64 bit)
MySQL - 10.2.6-MariaDB-log : Database - blizzcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `avatars` */

DROP TABLE IF EXISTS `avatars`;

CREATE TABLE `avatars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1 COMMENT '1 = user | 2 = staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `avatars` */

insert  into `avatars`(`id`,`name`,`type`) values 
(1,'default.png',1),
(2,'arthas.png',1),
(3,'deathwing.png',1),
(4,'garrosh.png',1),
(5,'ghoul.png',1),
(6,'hogger.png',1),
(7,'illidan.png',1),
(8,'kelthuzad.png',1),
(9,'kiljeaden.png',1),
(10,'lurker.png',1),
(11,'maiev.png',1),
(12,'malfurion.png',1),
(13,'neptulon.png',1),
(14,'nerzhul.png',1),
(15,'velen.png',1),
(16,'worgen.png',1),
(17,'imp.png',1),
(18,'vault_guardian.png',1);

/*Table structure for table `bugtracker` */

DROP TABLE IF EXISTS `bugtracker`;

CREATE TABLE `bugtracker` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `url` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `type` int(1) NOT NULL DEFAULT 1,
  `priority` int(1) NOT NULL DEFAULT 1,
  `date` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `close` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bugtracker` */

/*Table structure for table `bugtracker_priority` */

DROP TABLE IF EXISTS `bugtracker_priority`;

CREATE TABLE `bugtracker_priority` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bugtracker_priority` */

insert  into `bugtracker_priority`(`id`,`title`) values 
(1,'High'),
(2,'Medium'),
(3,'Low');

/*Table structure for table `bugtracker_status` */

DROP TABLE IF EXISTS `bugtracker_status`;

CREATE TABLE `bugtracker_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `bugtracker_status` */

insert  into `bugtracker_status`(`id`,`title`) values 
(1,'New Report'),
(2,'Waiting more information'),
(3,'Report confirmed'),
(4,'In progress'),
(5,'Fix need test'),
(6,'Fix need review'),
(7,'Invalid'),
(8,'Resolved');

/*Table structure for table `bugtracker_type` */

DROP TABLE IF EXISTS `bugtracker_type`;

CREATE TABLE `bugtracker_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `bugtracker_type` */

insert  into `bugtracker_type`(`id`,`title`) values 
(1,'Achievements'),
(2,'Battle Pets'),
(3,'Battlegrounds - Arena'),
(4,'Classes'),
(5,'Creatures'),
(6,'Exploits/Usebugs'),
(7,'Garrison'),
(8,'Guilds'),
(9,'Instances'),
(10,'Items'),
(11,'Other'),
(12,'Professions'),
(13,'Quests'),
(14,'Website');

/*Table structure for table `changelogs` */

DROP TABLE IF EXISTS `changelogs`;

CREATE TABLE `changelogs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `changelogs` */

/*Table structure for table `chars_annotations` */

DROP TABLE IF EXISTS `chars_annotations`;

CREATE TABLE `chars_annotations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idchar` int(10) NOT NULL,
  `annotation` text CHARACTER SET utf8 NOT NULL,
  `date` int(10) NOT NULL,
  `realmid` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chars_annotations` */

/*Table structure for table `credits` */

DROP TABLE IF EXISTS `credits`;

CREATE TABLE `credits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` int(11) unsigned NOT NULL,
  `dp` int(11) NOT NULL DEFAULT 0,
  `vp` int(11) NOT NULL DEFAULT 0,
  `lastVote` int(10) NOT NULL DEFAULT 1490579700,
  `maxVotes` int(10) unsigned NOT NULL DEFAULT 5,
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `accountId` (`accountid`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `credits` */

/*Table structure for table `donate` */

DROP TABLE IF EXISTS `donate`;

CREATE TABLE `donate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `tax` varchar(10) NOT NULL DEFAULT '0.00',
  `points` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `donate` */

insert  into `donate`(`id`,`name`,`price`,`tax`,`points`) values 
(1,'Simple','10.00','0.00',20),
(2,'Normal','20.00','2.00',22),
(3,'Professional','30.00','0.00',40);

/*Table structure for table `donate_history` */

DROP TABLE IF EXISTS `donate_history`;

CREATE TABLE `donate_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `total` varchar(10) NOT NULL,
  `complete` int(1) NOT NULL DEFAULT '0',
  `create_time` varchar(100) NOT NULL,
  `points` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `donate_history` */

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `date_event_start` int(10) NOT NULL,
  `date_event_end` int(10) NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `events` */

/*Table structure for table `faq` */

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `faq` */

/*Table structure for table `faq_type` */

DROP TABLE IF EXISTS `faq_type`;

CREATE TABLE `faq_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `faq_type` */

insert  into `faq_type`(`id`,`title`) values 
(1,'General'),
(2,'Server'),
(3,'Website');

/*Table structure for table `forum_category` */

DROP TABLE IF EXISTS `forum_category`;

CREATE TABLE `forum_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`categoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `forum_category` */

/*Table structure for table `forum_comments` */

DROP TABLE IF EXISTS `forum_comments`;

CREATE TABLE `forum_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `topic` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `commentary` text CHARACTER SET utf8 NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `forum_comments` */

/*Table structure for table `forum_forums` */

DROP TABLE IF EXISTS `forum_forums`;

CREATE TABLE `forum_forums` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category` int(10) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'icon1.png',
  `type` int(1) NOT NULL DEFAULT 1 COMMENT '1 = everyone | 2 = staff | 3 = staff post + everyone see',
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `forum_forums` */

/*Table structure for table `forum_topics` */

DROP TABLE IF EXISTS `forum_topics`;

CREATE TABLE `forum_topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forums` int(10) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `pinned` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `archivar` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `forum_topics` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `father` int(10) NOT NULL DEFAULT 0,
  `son` int(10) NOT NULL DEFAULT 0,
  `type` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`url`,`icon`,`father`,`son`,`type`) values 
(1,'More','#','fas fa-bars',1,0,0),
(2,'News','news','fas fa-newspaper',0,0,0),
(3,'FAQ','faq','fas fa-question-circle',0,1,0),
(4,'PvP','pvp','fas fa-fist-raised',0,1,0),
(5,'Forum','forum','fas fa-comments',0,0,0),
(6,'Store','store','fas fa-store',0,0,0);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`status`) values 
(1,'Installation',1),
(2,'Discord',1),
(3,'reCaptcha',0),
(4,'Slideshow',1),
(5,'Realm Status',1),
(6,'Register',1),
(7,'Login',1),
(8,'Recovery',0),
(9,'User Panel',1),
(10,'Admin Panel',1),
(11,'News',1),
(12,'Forum',1),
(13,'Store',1),
(14,'Donation',1),
(15,'Vote',1),
(16,'PVP',1),
(17,'Bugtracker',1),
(18,'Changelogs',1),
(19,'FAQ',1),
(20,'Events',0);

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'news.jpg' COMMENT 'includes/images/news',
  `description` text NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

insert  into `news`(`id`,`title`,`image`,`description`,`date`) values 
(1,'Welcome to your new website!','news.jpg','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Your site has been installed successfully. To continue, sign in with your account and go to the administration panel to have access to all the features provided. don\'t forget that if you have problems you can contact us by <a title=\"WoW-CMS\" href=\"https://discord.gg/vZG9vpS\" target=\"_blank\" rel=\"noopener\">Discord</a></p>\r\n</body>\r\n</html>',1551283156);

/*Table structure for table `news_comments` */

DROP TABLE IF EXISTS `news_comments`;

CREATE TABLE `news_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_new` int(10) NOT NULL,
  `commentary` text NOT NULL,
  `date` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_new` (`id_new`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `news_comments` */

/*Table structure for table `news_top` */

DROP TABLE IF EXISTS `news_top`;

CREATE TABLE `news_top` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_new` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_new` (`id_new`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `news_top` */

insert  into `news_top`(`id`,`id_new`) values 
(1,1);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uri_friendly` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `URI` (`uri_friendly`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pages` */

/*Table structure for table `pending_users` */

DROP TABLE IF EXISTS `pending_users`;

CREATE TABLE `pending_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `password_bnet` varchar(100) DEFAULT NULL,
  `expansion` int(10) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pending_users` */

/*Table structure for table `ranks_default` */

DROP TABLE IF EXISTS `ranks_default`;

CREATE TABLE `ranks_default` (
  `id` int(10) NOT NULL,
  `comment` varchar(100) DEFAULT 'Rank BlizzCMS',
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ranks_default` */

insert  into `ranks_default`(`id`,`comment`) values 
(1,'Rank Admin'),
(2,'Rank Visitor'),
(3,'Rank User');

/*Table structure for table `realms` */

DROP TABLE IF EXISTS `realms`;

CREATE TABLE `realms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(100) DEFAULT '127.0.0.1',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `char_database` varchar(255) DEFAULT NULL,
  `realmID` int(1) NOT NULL,
  `console_hostname` varchar(100) DEFAULT '127.0.0.1',
  `console_username` varchar(255) DEFAULT NULL,
  `console_password` varchar(255) DEFAULT NULL,
  `console_port` int(6) DEFAULT 7878,
  `emulator` varchar(255) DEFAULT 'TC',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `realms` */

/*Table structure for table `slides` */

DROP TABLE IF EXISTS `slides`;

CREATE TABLE `slides` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'slide1.jpg' COMMENT 'includes/images/slides',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `slides` */

insert  into `slides`(`id`,`title`,`image`) values 
(1,'BlizzCMS','slide1.jpg'),
(2,'Constant updates!','slide2.jpg');

/*Table structure for table `store` */

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT NULL,
  `type` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price_dp` int(10) DEFAULT NULL,
  `price_vp` int(10) DEFAULT NULL,
  `iconname` varchar(255) NOT NULL,
  `groups` int(1) NOT NULL,
  `qquery` text DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'item1.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `store` */

/*Table structure for table `store_groups` */

DROP TABLE IF EXISTS `store_groups`;

CREATE TABLE `store_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `store_groups` */

/*Table structure for table `store_history` */

DROP TABLE IF EXISTS `store_history`;

CREATE TABLE `store_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idstore` int(10) NOT NULL,
  `itemid` int(10) DEFAULT NULL,
  `date` int(10) NOT NULL,
  `accountid` int(10) NOT NULL,
  `charid` int(10) DEFAULT NULL,
  `method` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `store_history` */

/*Table structure for table `store_top` */

DROP TABLE IF EXISTS `store_top`;

CREATE TABLE `store_top` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_store` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_store` (`id_store`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `store_top` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` int(10) NOT NULL,
  `profile` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*Table structure for table `users_annotations` */

DROP TABLE IF EXISTS `users_annotations`;

CREATE TABLE `users_annotations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) NOT NULL,
  `annotation` text NOT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users_annotations` */

/*Table structure for table `votes` */

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `time` int(10) NOT NULL,
  `points` int(10) NOT NULL DEFAULT 1,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `votes` */

/*Table structure for table `votes_logs` */

DROP TABLE IF EXISTS `votes_logs`;

CREATE TABLE `votes_logs` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `idaccount` int(10) NOT NULL,
  `idvote` int(10) NOT NULL,
  `points` int(10) NOT NULL,
  `lasttime` int(10) NOT NULL,
  `expired_at` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `votes_logs` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
