<?php

include "dbcnx.php";

$mysqli->query("create table if not exists `rpointsO` (
  `playerid` int,
  `nameComposite` varchar(130) NOT NULL,
  `tournid` varchar(40) NOT NULL,
  `tourndate` date,
  `TRP` varchar(5),
  `tournrnds` smallint,
  `actor` varchar(100)
)" );

$mysqli->close();

?>

