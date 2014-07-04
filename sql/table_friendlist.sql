DROP TABLE IF EXISTS `financeapp`.`friendlist`;
CREATE TABLE  `financeapp`.`friendlist` (
  `userId` int(10) unsigned NOT NULL,
  `friendId` int(10) unsigned NOT NULL,
  `friendDeleted` BOOLEAN DEFAULT false
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;