DROP TABLE IF EXISTS `financeapp`.`goalmember`;
CREATE TABLE  `financeapp`.`goalmember` (
  `goalId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;