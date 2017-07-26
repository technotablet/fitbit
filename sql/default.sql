CREATE TABLE `data_raw` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fbdate` date NOT NULL,
  `fbuser` varchar(100) NOT NULL,
  `fbjsondata` mediumtext NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fbuser` (`fbdate`,`fbuser`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Capture Fitbit Raw JSON Data';

