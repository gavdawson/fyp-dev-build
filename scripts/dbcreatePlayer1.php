<?php

include "dbcnx.php";

$mysqli->query("create table if not exists `playerO` (
  `playerid` int NOT NULL AUTO_INCREMENT,
  `nameComposite` varchar(130) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `forenames` varchar(60),
  `scrabtitle` varchar(5),
  `title` varchar(20),
  `addr` varchar(200),
  `postcode` varchar(16),
  `club` varchar(50),
  `lastplayed` date,
  `member` varchar(1),
  `membno` int,
  `comment` varchar(400),
  `actor` varchar(100),
  `updated` datetime,
  PRIMARY KEY ( `playerid` )
)" );

$mysqli->close();

?>
