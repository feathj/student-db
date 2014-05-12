# Dump of table teacher
# ------------------------------------------------------------

CREATE TABLE `teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `tenure` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table class
# ------------------------------------------------------------

CREATE TABLE `class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `credit_hours` float(2,1) DEFAULT '3.0',
  `teacher_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `class_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table assignment
# ------------------------------------------------------------

CREATE TABLE `assignment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `class_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table student
# ------------------------------------------------------------

CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `year` varchar(255) DEFAULT '',
  `credit_hours` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table student_assignment
# ------------------------------------------------------------

CREATE TABLE `student_assignment` (
  `student_id` int(11) unsigned NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `letter_grade` char(1) DEFAULT NULL,
  PRIMARY KEY (`student_id`,`assignment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table student_class
# ------------------------------------------------------------

CREATE TABLE `student_class` (
  `student_id` int(11) unsigned NOT NULL,
  `class_id` int(11) unsigned NOT NULL,
  `date_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`class_id`,`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user
# ------------------------------------------------------------

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `encrypted_password` varchar(50) NOT NULL DEFAULT '',
  `salt` varchar(50) NOT NULL DEFAULT '',
  `is_admin` bit(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Seed initial admin record
INSERT INTO user(email,first_name,last_name,encrypted_password,salt,is_admin)
VALUES('admin@test.com','Admin','User','4d8ec8dd82500b9a300e06670b8048298cd75728','26d6f87e215ee4d38b3cbc3fff43202e8c9310c3',1);
