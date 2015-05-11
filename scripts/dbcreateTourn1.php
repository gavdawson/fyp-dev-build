<?php

include "dbcnx.php";

$mysqli->query("create table if not exists `tournmtO` (
  `tournid` varchar(40) NOT NULL PRIMARY KEY COMMENT 'unique tournament id',
  `tourntitle` varchar(200),
  `venue` varchar(400),
  `tourndate` datetime,
  `organiser` varchar(150),
  `orgphone` varchar(20),
  `tournrounds` smallint,
  `maxrating` smallint,
  `minrating` smallint,
  `comment` varchar(400),
  `actor` varchar(100),
  `updated` datetime
)" );

$mysqli->close();

?>
