<?php

include "dbcnx.php";

$mysqli->query("create table if not exists `files` (
  `fid` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique id',
  `fn` varchar(40) NOT NULL COMMENT 'file name',
  `mtype` varchar(40) NOT NULL COMMENT 'MIME type',
  `size` INT(11) NOT NULL COMMENT 'file size',
  `content` MEDIUMBLOB NOT NULL COMMENT 'actual file'
)" );

$mysqli->close();

?>
