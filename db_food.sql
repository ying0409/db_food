-- --------------------------------------------------------
-- 主機:                           140.122.184.129
-- 伺服器版本:                        10.3.9-MariaDB - mariadb.org binary distribution
-- 伺服器操作系統:                      Win64
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 傾印 db_class 的資料庫結構
CREATE DATABASE IF NOT EXISTS `db_food` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `db_food`;

-- 傾印  表格 db_class.student 結構
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StuName` char(50) COLLATE utf8_bin NOT NULL,
  `StuNum` int(11) NOT NULL,
  `passwd` char(50) COLLATE utf8_bin DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create table customer(
	c_id varchar(5),
	name varchar(10) not null,
	account varchar (6) not null,
	password varchar (10) not null,
	email varchar(25),
	primary key(c_id)
) ENGINE=INNODB;
create table manager(
	m_id varchar(5),
	name varchar(10) not null,
	account varchar (6) not null,
	password varchar (10) not null,
	email varchar(25),
	primary key(m_id)
) ENGINE=INNODB;
create table shop(
	s_id varchar(5),
	m_id varchar(5),
	name varchar(10) not null,
	time_id varchar(5)
	style varchar(10),
	phone varchar(10),
	website varchar(20),
	address varchar(20),
	aveprice numeric(4,0),
	primary key(s_id),
	foreign key (m_id) references manager(m_id)
	on delete set null
) ENGINE=INNODB;
create table discount(
	d_id varchar(5),
	content varchar(10) not null,
	primary key(d_id)
) ENGINE=INNODB;
create table provide(
	s_id varchar(5),
	d_id varchar(5),
	primary key(s_id,d_id),
	foreign key (s_id) references shop(s_id)
	on delete cascade,
	foreign key (d_id) references discount(d_id)
	on delete cascade
) ENGINE=INNODB;
create table menu(
	s_id varchar(5),
	name varchar(10),
	price numeric(4,0),
	primary key(s_id,name,price),
	foreign key (s_id) references shop(s_id)
	on delete cascade
) ENGINE=INNODB;
create table time(
	time_id varchar(5),
	when varchar(10),
	op_hr numeric(2) check (op_hr >= 0 and op_hr < 24),
	op_min numeric(2) check (op_min >= 0 and op_min < 60),
	cl_hr numeric(2) check (cl_hr >= 0 and cl_hr < 24),
	cl_min numeric(2) check (cl_min >= 0 and cl_min < 60)
	primary key(time_id,when,op_hr,op_min,cl_hr,cl_min),
) ENGINE=INNODB;
create table favorate(
	c_id varchar(5),
	s_id varchar(5),
	primary key(c_id,s_id),
	foreign key (c_id) references customer(c_id)
	on delete cascade,
	foreign key (s_id) references shop(s_id)
	on delete cascade
) ENGINE=INNODB;
create table comment(
	c_id varchar(5),
	s_id varchar(5),
	star numeric(5,0) not null,
	content varchar(10)
	primary key(c_id,s_id),
	foreign key (c_id) references customer(c_id)
	on delete cascade,
	foreign key (s_id) references shop(s_id)
	on delete cascade
) ENGINE=INNODB;

-- 正在傾印表格  db_class.student 的資料：~2 rows (大約)
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`id`, `StuName`, `StuNum`, `passwd`, `gender`) VALUES
	(2, 'Bryant', 24, '123345fff', 1),
	(3, 'Robert Baratheon', 55, '123456', 1),
	(4, 'Jaime Lannister', 56, '123456', 1),
	(5, 'Catelyn Stark', 57, '123456', 0),
	(6, 'Cersei Lannister', 58, '123456', 0),
	(7, 'Daenerys Targaryen', 59, '123456', 0),
	(8, 'Jorah Mormont', 60, '123456', 1),
	(9, 'Viserys Targaryen', 61, '123456', 0),
	(10, 'Jon Snow', 62, '123456', 1),
	(11, 'Sansa Stark', 63, '123456', 0),
	(12, 'Arya Stark', 64, '123456', 0),
	(13, 'Robb Stark', 65, '123456', 1),
	(14, 'Theon Greyjoy', 66, '123456', 1),
	(15, 'Bran Stark', 67, '123456', 1),
	(16, 'Joffrey Baratheon', 68, '123456', 1),
	(17, 'Tyrion Lannister', 69, '123456', 1),
	(18, 'Petyr Baelish', 70, '123456', 1),
	(19, 'Samwell Tarly', 71, '123456', 1),
	(20, 'Jeor Mormont', 72, '123456', 1),
	(21, 'Bronn', 73, '123456', 1),
	(22, 'Varys', 74, '123456', 1),
	(23, 'Shae', 75, '123456', 0),
	(24, 'Tywin Lannister', 76, '123456', 1),
	(25, 'Gendry', 77, '123456', 1),
	(26, 'Tommen Baratheon', 78, '123456', 1),
	(27, 'James', 23, '12345678', 1);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
