<?php

include "dbcnx.php";

if (! $mysqli->query("create table if not exists `matchdetO` (
  `tournid` varchar(40) NOT NULL,
  `playerid` int,
  `oppoid` int,
  `round` smallint,
  `spread` smallint,
  `flag` varchar(10),
  `actor` varchar(100),
  `comment` varchar(200),
  `updated` datetime
)" ) )
{
  echo "Db create table failed, matchdetO<br/>";
  echo $mysqli->error;
}

$mysqli->close();

?>

