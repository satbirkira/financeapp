DROP TABLE IF EXISTS `financeapp`.`account`;
CREATE TABLE `financeapp`.`account` (
  `accountID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `userCurrentlySaved` int(10) NOT NULL DEFAULT '0',
  `userMonthlyIncome` int(10) NOT NULL DEFAULT '0',
  `userInterestOnSavings` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312 ROW_FORMAT=DYNAMIC;