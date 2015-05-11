<?php

include "dbcnx.php";

$mysqli->query("create table if not exists `tournmtRoster` (
  `tournid` varchar(40) NOT NULL,
  `playerid` int,
  `entryRating` int,
  `rosterNum` smallint
)" );

$mysqli->close();

?>

