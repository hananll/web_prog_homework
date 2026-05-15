CREATE DATABASE IF NOT EXISTS `databaselesson`
CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `databaselesson`;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `first_name` varchar(45) NOT NULL default '',
  `last_name` varchar(45) NOT NULL default '',
  `user_name` varchar(12) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `users` (`id`,`first_name`,`last_name`,`user_name`,`password`) VALUES
 (1,'FirstName_1','LastName_1','Login1',sha1('login1')),
 (2,'FirstName_2','LastName_2','Login2',sha1('login2')),
 (3,'FirstName_3','LastName_3','Login3',sha1('login3')),
 (4,'FirstName_4','LastName_4','Login4',sha1('login4')),
 (5,'FirstName_5','LastName_5','Login5',sha1('login5')),
 (6,'FirstName_6','LastName_6','Login6',sha1('login6')),
 (7,'FirstName_7','LastName_7','Login7',sha1('login7')),
 (8,'FirstName_8','LastName_8','Login8',sha1('login8')),
 (9,'FirstName_9','LastName_9','Login9',sha1('login9')),
 (10,'FirstName_10','LastName_10','Login10',sha1('login10')),
 (11,'FirstName_11','LastName_11','Login11',sha1('login11')),
 (12,'FirstName_12','LastName_12','Login12',sha1('login12'));


CREATE TABLE IF NOT EXISTS `naming` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nev` varchar(100) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `naming` (`id`, `nev`) VALUES
 (1, 'cable laying'),
 (2, 'junction construction'),
 (3, 'pothole patching'),
 (4, 'road construction'),
 (5, 'asphalt milling'),
 (6, 'flood'),
 (7, 'asphalting'),
 (8, 'gap sealing'),
 (9, 'rut elimination'),
 (10, 'canal'),
 (11, 'ditch and shoulder maintenance');


CREATE TABLE IF NOT EXISTS `extent` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nev` varchar(100) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `extent` (`id`, `nev`) VALUES
 (1, 'lane narrowing'),
 (2, 'lane closure'),
 (3, 'carriageway closure'),
 (4, 'complete closure'),
 (5, 'no closure'),
 (6, 'passable with difficulty');


CREATE TABLE IF NOT EXISTS `restriction` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `roadnumber` int(10) NOT NULL,
  `frompoint` varchar(20) NOT NULL default '',
  `topoint` varchar(20) NOT NULL default '',
  `settlement` varchar(100) NOT NULL default '',
  `fromwhen` date NOT NULL,
  `towhen` date NOT NULL,
  `namingid` int(10) unsigned NOT NULL,
  `extentid` int(10) unsigned NOT NULL,
  `speed` int(3) default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `restriction` (`roadnumber`,`frompoint`,`topoint`,`settlement`,`fromwhen`,`towhen`,`namingid`,`extentid`,`speed`) VALUES
 (1,'74,820','75,977','Almásfüzitő','2010-06-03','2010-06-21',1,1,30),
 (1,'169,410','170,320','Levél','2010-03-16','2010-06-30',2,2,40),
 (3,'178,970','187,145','Miskolc','2010-05-31','2010-06-30',3,1,30),
 (4,'304,000','313,000','Nyírtass','2010-05-29','2010-10-05',4,1,40),
 (4,'306,000','307,000','Nyírtass','2010-03-24','2010-10-05',2,1,40),
 (4,'336,580','341,222','Záhony','2010-05-29','2010-10-05',4,1,40),
 (4,'287,790','288,910','Nyírtura','2010-03-10','2010-10-05',4,1,40),
 (4,'319,250','319,775','Kisvárda','2010-05-29','2010-10-05',4,1,40),
 (4,'313,000','315,000','Pátroha','2010-05-05','2010-10-05',4,1,40),
 (4,'241,650','248,480','Hajdúhadház - Téglás','2010-07-08','2010-07-30',4,5,60),
 (4,'248,480','260,200','Újfehértó','2010-03-16','2010-10-30',5,1,30),
 (4,'336,580','337,910','Tiszabezdéd','2010-03-10','2010-10-05',2,1,40),
 (4,'180,400','200,100','Püspökladány - Hajdúszoboszló','2010-03-09','2010-07-31',4,3,40),
 (6,'66,300','67,000','Dunaújváros','2010-06-01','2010-06-15',6,1,40),
 (8,'43,500','44,600','Litér','2010-10-15','2010-11-30',2,1,50),
 (11,'37,740','37,850','Dunabogdány','2010-05-17','2010-06-21',4,3,30),
 (11,'24,250','24,300','Leányfalu','2010-05-17','2010-06-25',4,1,30),
 (11,'25,900','26,100','Leányfalu','2010-05-03','2010-06-30',4,1,30),
 (13,'3,293','3,948','Komárom','2010-04-26','2010-08-15',2,1,40),
 (21,'15,060','16,530','Apc','2010-03-15','2010-09-30',4,1,60),
 (21,'7,850','9,750','Lőrinci','2010-03-15','2010-09-30',4,1,60),
 (21,'57,800','58,100','Salgótarján','2010-05-17','2010-06-15',4,2,30),
 (31,'27,540','32,721','Maglód - Mende','2010-03-17','2010-06-18',4,3,20),
 (31,'34,107','40,764','Mende','2010-03-17','2010-06-18',4,3,20),
 (31,'32,721','34,107','Mende','2010-03-17','2010-06-18',4,3,20),
 (32,'57,282','58,291','Újszász','2010-03-17','2010-06-15',7,3,40),
 (32,'27,400','27,900','Jászberény','2010-05-07','2010-08-06',2,1,30),
 (47,'1,115','1,255','Debrecen','2010-03-30','2010-06-30',4,1,30),
 (47,'217,800','218,100','Algyő','2010-03-17','2010-06-30',4,2,60),
 (55,'100,060','100,175','Baja','2010-03-22','2010-07-31',2,4,30),
 (61,'154,520','155,800','Böhönye - Vése','2010-03-15','2010-11-15',7,1,50),
 (61,'165,500','166,200','Vése - Inke','2010-03-15','2010-11-15',7,1,40),
 (86,'94,500','98,600','Szeleste','2010-09-08','2010-11-30',4,1,40),
 (451,'25,135','27,050','Csongrád','2010-03-22','2010-08-27',2,1,40),
 (471,'71,000','72,150','Mátészalka','2010-03-30','2010-06-30',4,1,30);


CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(120) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message_body` text NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_messages_created_at` (`created_at`),
  KEY `idx_messages_user_id` (`user_id`)
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `image_uploads` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `file_name` varchar(190) NOT NULL,
  `uploaded_by` varchar(60) NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_image_uploads_uploaded_at` (`uploaded_at`)
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;