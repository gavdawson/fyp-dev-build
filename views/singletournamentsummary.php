

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB" lang="en-GB">


<head>

<title>ABSP - Single Tournament Summary</title>

<!-- Loads stylesheets and scripts -->

<link rel="stylesheet" type="text/css" href="/fyp-dev-build/css/norm.css" />
<link rel="stylesheet" type="text/css" href="/fyp-dev-build/css/style.css" />

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="/fyp-dev-build/js/jquery.js"></script>
<script src="/fyp-dev-build/js/table-sorter.js"></script>
<script src="/fyp-dev-build/js/jquery.dataTables.min.js"></script>

</head>

<!-- Assigns variables to be passed into URL -->

<?php 
$tournid = htmlspecialchars($_GET["tournid"]);
$tourntitle = htmlspecialchars($_GET["tourntitle"]);
$tourndate = htmlspecialchars($_GET["tourndate"]);
$playerid = htmlspecialchars($_GET["playerid"]);
$playername = htmlspecialchars($_GET["playername"]);
$location = htmlspecialchars($_GET["location"]);
$wins = htmlspecialchars($_GET["wins"]);
$losses = htmlspecialchars($_GET["losses"]);
$draws = htmlspecialchars($_GET["draws"]);
$winperc = htmlspecialchars($_GET["winperc"]);
?>

<body>

<!-- ABSP Branding shell -->

<div class="top"> 
    <img class="tops" src="/fyp-dev-build/images/absp_logo.PNG" width="204" height="80" alt="Association of British Scrabble Players" />
</div>
<div id="nav"> 
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">The ABSP</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Play</a></li>
        <li><a href="#">Results</a></li>
        <li><a href="#">Words</a></li>
        <li><a href="#">Photos</a></li>
    </ul>
</div>

<p style="clear: both;"></p>

<div class="gav" style="float: left;">
    <h2><?php echo $tourntitle;?></h2>
    <h2><?php echo $tourndate;?></h2>
    <h3>(NUMBER OF DIVISIONS) | (INSERT NUMBER OF PLAYERS) | (INSERT NUMBER OF GAMES)</h3>
</div>

<p style="clear: both;"></p>

<div class="gav" style="clear: both; border-bottom: none;">
    <h2>(DIVISION NAME (CHANGE ON FILTER))</h2>
</div>

<div class="gav">

<?php
$servername 	= "localhost";
$username 		= "root";
$password 		= "mysql";
$dbname 		= "absporgu_membership";
$orderby 		= '';
$sort 			= '';

// Creates connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Checks connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL Statement that pulls content from the database

$sql = "SELECT *, sum(numwins) as wins, sum(numlosses) as losses, sum(numdraws) as draws, count(tournid) as tourneys FROM tournmtSummary join playerO on tournmtSummary.playerid=playerO.playerid group by tournmtSummary.playerid ORDER BY `tourneys` DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	?>
    <table id="example" class="new-table row-border hover order-column" cellspacing="0" width="100%">        
        <thead>
            <tr>
                
            <th>
                Place
            </th>
            <th>
                Seed
            </th>
    		<th>
    			Name
    		</th>
    		<th>
    			W
    		</th>
    		<th>
    			L
    		</th>
            <th>
                D
            </th>
            <th>
                B
            </th>
            <th>
                Spread
            </th>
            <th>
                Old Rating
            </th>
            <th>
                Perf Rating
            </th>
            <th>
                New Rating
            </th>
        </tr>
    	</head>
        <tbody  id="fbody">
    <?php

    // Outputs data of each row

    while($row = $result->fetch_assoc()) {
        $gametotal = $row["wins"] + $row["losses"] + $row["draws" ];
        $winperans = $row["wins"] / $gametotal * 100;
    	?>

        <!-- Displays desired content in columns -->
        
        <tr>
        	<td><?php echo $row["0"];?></td>
            <td><?php echo $row["0"];?></td>
            <td><a href="/fyp-dev-build/views/singleplayersummary.php?playerid=<?php echo $row["playerid"] . '&playername=' . $row["forenames"] . ' ' .  $row["surname"]. '&location=' . $row["club"] . '&wins=' . $row["wins"] . '&losses=' . $row["losses"] . '&draws=' . $row["draws"] . '&winperc=' . round($winperans, 2) . '%' ;?>"><?php echo $row["forenames"];?> <?php echo $row["surname"];?></a></td>
        	<td><?php echo $row["numwins"];?></td>
        	<td><?php echo $row["numlosses"];?></td>        	
            <td><?php echo $row["numdraws"];?></td>
            <td><?php echo $row["numbyes"];?></td>
            <td><?php echo $row["0"];?></td> 
            <td><?php echo $row["0"];?></td> 
            <td><?php echo $row["0"];?></td>
            <td><?php echo $row["0"];?></td>                    
        </tr>
    
        <?php
    }
    ?>
    </tbody>
</table>
</div>
    <?php
} else {
	?>
	<p>0 results</p>
	<?php
}
$conn->close();
?>

</body>