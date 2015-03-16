<?php

include "dbcnx.php";

if (! $mysqli->query("create table if not exists `tournmtSummary` (
  `tournid` varchar(40) NOT NULL,
  `playerid` int,
  `numwins` smallint,
  `numlosses` smallint,
  `numdraws` smallint,
  `numbyes` smallint,
  `actor` varchar(100),
  `updated` datetime
)" ) )
{
  echo "Db create table failed, tournmtSummary<br/>";
  echo $mysqli->error;
}

$mysqli->close();

?>
