CREATE  TABLE `harmoney_run_with_me`.`Users_rk` (

  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `birthday` VARCHAR(45) NULL ,
  `location` VARCHAR(45) NULL ,
  `gender` VARCHAR(10) NULL ,
  `athlete_type` VARCHAR(40) NULL ,
  `profile` VARCHAR(145) NULL ,

  PRIMARY KEY (`id`) );
  
  
  
CREATE  TABLE `harmoney_run_with_me`.`Fitness_Activities` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `duration` VARCHAR(45) NULL ,

  `total_distance` VARCHAR(45) NULL ,

  `start_time` VARCHAR(45) NULL ,

  `type` VARCHAR(45) NULL ,

  `uri` VARCHAR(45) NULL ,
  
  `Uid` INT NOT NULL ,
  
  PRIMARY KEY (`id`) );
  
  
  

CREATE  TABLE `harmoney_run_with_me`.`User_facebook` (

  `id` INT NOT NULL ,

  `idUser_facebook` INT(45) NOT NULL ,

  `name` VARCHAR(45) NULL ,

  `link` VARCHAR(45) NULL ,

  `username` VARCHAR(45) NULL ,

  `hometown` VARCHAR(45) NULL ,

  `location` VARCHAR(45) NULL ,

  `education1` VARCHAR(45) NULL ,

  `education2` VARCHAR(45) NULL ,

  `education3` VARCHAR(45) NULL ,

  `education4` VARCHAR(45) NULL ,

  `gender` VARCHAR(45) NULL ,

  `religion` VARCHAR(45) NULL ,

  `political` VARCHAR(45) NULL ,

  `timezone` VARCHAR(45) NULL ,

  `locale` VARCHAR(45) NULL ,

  `languages1` VARCHAR(45) NULL ,

  `languages2` VARCHAR(45) NULL ,

  `languages3` VARCHAR(45) NULL ,

  `verified` TINYINT NULL ,

  `updated_time` VARCHAR(145) NULL ,

  PRIMARY KEY (`id`) );




 INSERT INTO `run_with_me`.`Users` (`birthday`, `location`, `medium_picture`, `name`, `elite`, `gender`, `athlete_type`, `normal_picture`, `profile`) VALUES ('Sun, 1 Oct 1972 00:00:00', ' Tel Aviv, Israel', 'http://graph.facebook.com/100003538821460/picture?type=small', 'danny.harmoneya', 'false', 'M', 'Runner', ' http://graph.facebook.com/100003538821460/picture?type=large', 'http://runkeeper.com/user/564356054');


 INSERT INTO `run_with_me`.`Fitness_Activities` (`duration`, `total_distance`, `start_time`, `type`, `uri`) VALUES ('433', '4555', 'Sun, 5 Aug 2012 19:57:00', 'Running', '/fitnessActivities/107518186');