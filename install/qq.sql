CREATE TABLE IF NOT EXISTS `qq_online` (
  `id` int(11) NOT NULL auto_increment,
  `qqNumber` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `time` text(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `qq_users` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `qq0` varchar(20) NOT NULL default '0',
  `sid0` varchar(100) NOT NULL default '0',
  `qq1` varchar(20) NOT NULL default '0',
  `sid1` varchar(100) NOT NULL default '0',
  `qq2` varchar(20) NOT NULL default '0',
  `sid2` varchar(100) NOT NULL default '0',
  `qq3` varchar(20) NOT NULL default '0',
  `sid3` varchar(100) NOT NULL default '0',
  `qq4` varchar(20) NOT NULL default '0',
  `sid4` varchar(100) NOT NULL default '0',
  `qq5` varchar(20) NOT NULL default '0',
  `sid5` varchar(100) NOT NULL default '0',
  `qq6` varchar(20) NOT NULL default '0',
  `sid6` varchar(100) NOT NULL default '0',
  `qq7` varchar(20) NOT NULL default '0',
  `sid7` varchar(100) NOT NULL default '0',
  `qq8` varchar(20) NOT NULL default '0',
  `sid8` varchar(100) NOT NULL default '0',
  `qq9` varchar(20) NOT NULL default '0',
  `sid9` varchar(100) NOT NULL default '0',
  `qq10` varchar(20) NOT NULL default '0',
  `sid10` varchar(100) NOT NULL default '0',
  `qq11` varchar(20) NOT NULL default '0',
  `sid11` varchar(100) NOT NULL default '0',
  `cont` int(11) unsigned NOT NULL default '0',
  `admin` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`name`),
  KEY `name` (`name`),
  KEY `pass` (`pass`)
)

