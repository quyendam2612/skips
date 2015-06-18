/*
SQLyog Ultimate v12.1 (32 bit)
MySQL - 5.5.28 : Database - kielyskipsdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kielyskipsdb` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `tblpostcodeareas` */

DROP TABLE IF EXISTS `tblpostcodeareas`;

CREATE TABLE `tblpostcodeareas` (
  `areacode` varchar(2) NOT NULL,
  `areaname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`areacode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tblpostcodeareas` */

insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('AB','Aberdeen');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('AL','St Albans');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('B','Birmingham');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BA','Bath');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BB','Blackburn');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BD','Bradford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BH','Bournemouth');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BL','Bolton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BN','Brighton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BR','Bromley');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BS','Bristol');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('BT','Belfast');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CA','Carlisle');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CB','Cambridge');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CF','Cardiff');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CH','Chester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CM','Chelmsford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CO','Colchester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CR','Croydon');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CT','Canterbury');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CV','Coventry');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('CW','Crewe');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DA','Dartford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DD','Dundee');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DE','Derby');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DG','Dumfries and Galloway');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DH','Durham');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DL','Darlington');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DN','Doncaster');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DT','Dorchester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('DY','Dudley');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('E','London E');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('EC','London EC');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('EH','Edinburgh');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('EN','Enfield');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('EX','Exeter');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('FK','Falkirk and Stirling');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('FY','Blackpool, Fylde');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('G','Glasgow');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('GL','Gloucester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('GU','Guildford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('GY','Guernsey');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HA','Harrow');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HD','Huddersfield');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HG','Harrogate');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HP','Hemel Hempstead');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HR','Hereford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HS','Outer Hebrides');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HU','Hull');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('HX','Halifax');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('IG','Ilford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('IM','Isle of Man');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('IP','Ipswich');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('IV','Inverness');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('JE','Jersey');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('KA','Kilmarnock');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('KT','Kingston upon Thames');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('KW','Kirkwall');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('KY','Kirkcaldy');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('L','Liverpool');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LA','Lancaster');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LD','Llandrindod Wells');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LE','Leicester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LL','Llandudno');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LN','Lincoln');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LS','Leeds');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('LU','Luton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('M','Manchester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('ME','Rochester, Medway');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('MK','Milton Keynes');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('ML','Motherwell');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('N','London N');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('NE','Newcastle upon Tyne');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('NG','Nottingham');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('NN','Northampton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('NP','Newport');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('NR','Norwich');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('NW','London NW');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('OL','Oldham');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('OX','Oxford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('PA','Paisley');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('PE','Peterborough');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('PH','Perth');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('PL','Plymouth');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('PO','Portsmouth');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('PR','Preston');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('RG','Reading');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('RH','Redhill');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('RM','Romford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('S','Sheffield');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SA','Swansea');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SE','London SE');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SG','Stevenage');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SK','Stockport');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SL','Slough');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SM','Sutton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SN','Swindon');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SO','Southampton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SP','Salisbury');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SR','Sunderland');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SS','Southend on Sea');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('ST','Stoke-on-Trent');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SW','London SW');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('SY','Shrewsbury');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TA','Taunton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TD','Galashiels, Tweeddale');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TF','Telford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TN','Tonbridge');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TQ','Torquay');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TR','Truro');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TS','Cleveland, Teesside');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('TW','Twickenham');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('UB','Southall, Uxbridge');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('W','London W');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WA','Warrington');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WC','London WC');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WD','Watford');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WF','Wakefield');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WN','Wigan');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WR','Worcester');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WS','Walsall');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('WV','Wolverhampton');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('YO','York');
insert  into `tblpostcodeareas`(`areacode`,`areaname`) values ('ZE','Lerwick, Zetland');

/*Table structure for table `tblpostcodezones` */

DROP TABLE IF EXISTS `tblpostcodezones`;

CREATE TABLE `tblpostcodezones` (
  `zoneid` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(2) DEFAULT NULL,
  `rangestart` int(11) DEFAULT NULL,
  `rangeend` int(11) DEFAULT NULL,
  `incode` varchar(4) DEFAULT NULL,
  `permittype` int(11) DEFAULT NULL,
  `driveonly` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`zoneid`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `tblpostcodezones` */

insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (37,'B',1,28,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (38,'B',30,31,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (39,'B',33,35,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (40,'B',38,38,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (41,'B',42,43,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (42,'B',72,73,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (43,'B',75,76,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (44,'B',36,37,NULL,7,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (45,'B',40,40,NULL,7,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (46,'B',90,94,NULL,7,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (47,'B',29,29,NULL,6,0);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (50,'B',44,48,NULL,6,1);
insert  into `tblpostcodezones`(`zoneid`,`town`,`rangestart`,`rangeend`,`incode`,`permittype`,`driveonly`) values (51,'B',74,74,NULL,6,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
