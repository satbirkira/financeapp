DROP TABLE IF EXISTS `financeapp`.`account`;
CREATE TABLE  `financeapp`.`account` (
  `userID` int(10) unsigned NOT NULL,
  `userMonthlyIncome` int(10) NOT NULL DEFAULT 0,
  `userInterestOnSavings` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userID`),
  FOREIGN KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312 ROW_FORMAT=DYNAMIC;