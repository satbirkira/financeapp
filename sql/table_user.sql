DROP TABLE IF EXISTS `financeapp`.`user`;
CREATE TABLE  `financeapp`.`user` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `userPassword` varchar(100) NOT NULL, 
  `userCreatedOn` DATE NOT NULL,
  `userEmail` varchar(45) DEFAULT NULL,
  `userFirstName` varchar(45) DEFAULT NULL,
  `userLastName` varchar(45) DEFAULT NULL,
  `userCurrentlySaved` int(10) NOT NULL DEFAULT '0',
  `userInterestOnSavings` int(11) NOT NULL DEFAULT '0',
  `userMonthlyIncome` int(10) NOT NULL DEFAULT '0',
  `userAccountUpdated` BOOLEAN DEFAULT FALSE,
  `userProfileImage` varchar(45) DEFAULT NULL,
  `userDeleted` BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312 ROW_FORMAT=DYNAMIC;