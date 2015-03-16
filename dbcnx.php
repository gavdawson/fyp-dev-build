<?php

$dbhost="localhost";
$dbuser="root";
$dbpass="";
$db="absporgu_membership";
$dbnull=null;

$mysqli=new mysqli($dbhost, $dbuser, $dbpass, $db);

if (mysqli_connect_errno())
{ trigger_error("DB cnx failed ".mysqli_connect_error(), E_USER_ERROR);
}

?>
