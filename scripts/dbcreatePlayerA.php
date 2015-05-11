<?php

include "dbcnx.php";

$mysqli->query("create table if not exists `playerAlias` (
  `playerid` int,
  `aliasComposite` varchar(130) NOT NULL,
  `aliasType` varchar(100),
  `actor` varchar(100),
  `updated` datetime
)" );

$mysqli->close();

?>
