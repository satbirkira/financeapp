DROP TABLE IF EXISTS `financeapp`.`goal`;
CREATE TABLE  `financeapp`.`goal` (
  `goalID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL, 
  `goalName` varchar(45) NOT NULL,
  `startDate` DATE NOT NULL,
  `targetDate` DATE NOT NULL,
  `currentlySaved` int(10) NOT NULL DEFAULT 0,
  `goalDeleted` BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (`goalID`),
  FOREIGN KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312 ROW_FORMAT=DYNAMIC;