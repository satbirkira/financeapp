DROP TABLE IF EXISTS `financeapp`.`goal`;
CREATE TABLE `financeapp`.`goal` (
  `goalID` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` INTEGER UNSIGNED NOT NULL,
  `goalName` VARCHAR(45) NOT NULL,
  `startDate` DATE NOT NULL,
  `targetDate` DATE NOT NULL,
  `totalCost` DECIMAL NOT NULL DEFAULT 0.00,
  `monthlyDepot` DECIMAL DEFAULT 0.00,
  `interestRate` DECIMAL DEFAULT 0.00,
  `currentlySaved` DECIMAL DEFAULT 0.00,
  `goalStatus` BOOLEAN DEFAULT false,
  PRIMARY KEY (`goalID`),
  CONSTRAINT `FK_goal_1` FOREIGN KEY `FK_goal_1` (`userID`)
    REFERENCES `user` (`userID`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)
ENGINE = InnoDB;
