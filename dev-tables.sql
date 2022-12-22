-- CREATE DATABASE `dev_db`;
--
USE `dev_db`;
--
-- DROP TABLE `comments`;
-- DROP TABLE `users`;
-- DROP TABLE `user_groups`;
--
CREATE TABLE `user_groups` (
   `groupid` INT NOT NULL AUTO_INCREMENT,
   `group_name` VARCHAR (255),
   PRIMARY KEY (`groupid`),
   KEY (`group_name`)
);
--
CREATE TABLE `users` (
   `userid` INT NOT NULL AUTO_INCREMENT COMMENT 'id used to update things',
   `groupid` INT NOT NULL COMMENT 'id used to filter things',
   `name` VARCHAR(255) DEFAULT NULL COMMENT 'value seen by the user',
   PRIMARY KEY (`userid`),
   UNIQUE KEY (`name`),
   FOREIGN KEY (`groupid`) REFERENCES `user_groups`(`groupid`)
);
--
CREATE TABLE `comments` (
   `commentid` INT NOT NULL AUTO_INCREMENT COMMENT 'id used to update things',
   `userid` INT NOT NULL,
   `comment` TEXT DEFAULT NULL,
   PRIMARY KEY (`commentid`),
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`)
);
--
INSERT INTO `user_groups`
(`group_name`)
VALUES
('General'),
('Dev');
--
INSERT INTO `users`
(`groupid`, `name`)
VALUES
(1, 'David'),
(2, 'Chris')
;
--
INSERT INTO `comments`
(`userid`, `comment`)
VALUES
(1, 'Hello World');
--
-- SELECT `name`, `group_name`, `comment`
-- FROM `comments`
-- JOIN `users` USING (`userid`)
-- JOIN `user_groups` USING (`groupid`);

