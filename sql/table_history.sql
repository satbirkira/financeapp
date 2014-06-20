DROP TABLE IF EXISTS `financeapp`.`history`;
CREATE TABLE  `financeapp`.`history` (
  `historyID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goalID` int(10) NOT NULL, 
  `eventDate` DATE NOT NULL,
  `amountChanged` int(10) NOT NULL DEFAULT 0, --Can be positive or negative
  PRIMARY KEY (`historyID`),
  FOREIGN KEY (`goalID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312 ROW_FORMAT=DYNAMIC;