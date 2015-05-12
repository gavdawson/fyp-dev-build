

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB" lang="en-GB">


<head>

<title>ABSP - Single Player Summary</title>

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

$sql = "SELECT *, DATE_FORMAT(rpointsO.tourndate,'%d/%m/%y') AS dateformatted FROM tournmtSummary RIGHT JOIN rpointsO on tournmtSummary.tournid=rpointsO.tournid and tournmtSummary.playerid=rpointsO.playerid left JOIN tournmtO on tournmtSummary.tournid=tournmtO.tournid where rpointsO.playerid='$playerid' ORDER BY tourntitle DESC";

$result = $conn->query($sql);

?>

<p style="clear: both;"></p>
 
<div class="gav" style="float: left;">

<!-- Reads image from location and displays -->

<?php 
$filename = $playerid . 'PNG'; 
echo '<img class="player-image" style="float: left;" src="/fyp-dev-build/images/profile-pics/';
echo $playerid;
echo '.PNG" ';
echo 'onerror="this.src=';
echo "'/fyp-dev-build/images/player-image.PNG'";
echo '"';
echo '>';
?>

<h2 class="player-description"><?php echo $playername; ?> | <?php echo $location; ?></h2>

<table class="player-information-table">
    <thead>
        <tr>
            <th>
                <h3>Rating</h3>
            </th>
            <th>
                <h3>Ranking</h3>
            </th>
            <th>
                <h3>Lifetime record</h3>
            </th>
            <th>
                <h3>Avg. score</h3>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <h4>(SELECTED PLAYER RATING)</h4>
                <p>(SELECTED PLAYER PEAK RATING)</p>
            </td>
            <td>
                <h4>(SELECTED PLAYER RANK)</h4>
            </td>
            <td>
                <h4><?php echo $wins . ', ' . $losses . ', ' . $draws ?><h4>
                <h4><?php echo '(' . $winperc . ')';?></h4>
            </td>
            <td>
                <h4>(AVERAGE SCORE WIN - AVERAGE SCORE LOSS)</h4>
            </td>
        </tr>
    </tbody>
</table>

</div>

<p style="clear: both;"></p>

<div class="gav" style="clear: both; border-bottom: none;">
    <h2>Career Tournaments</h2>
</div>

<div class="gav">

<?php

if ($result->num_rows > 0) {
	?>
    <table id="example" class="new-table row-border hover order-column" cellspacing="0" width="100%">        
        <thead>
            <tr>
                
            <th>
                Tournament
            </th>
            <th>
                Date
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
                Place
            </th>
            <th>
                Seed
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
    	?>
        
        <!-- Displays desired content in columns -->

        <tr>
        	<td>
                <a href="/fyp-dev-build/views/singletournamentsummary.php?tournid=<?php echo $row["tournid"] . '&';
                echo 'tourntitle=' . $row["tourntitle"] . '&tourndate=' . $row["dateformatted"] . '&tournid=' . $row["tournid"];?>"><?php echo $row["tourntitle"];?></a>
            </td>
            <td><?php echo $row["dateformatted"];?></td>
            <td><?php echo $row["numwins"];?></td>
            <td><?php echo $row["numlosses"];?></td>            
            <td><?php echo $row["numdraws"];?></td>
            <td><?php echo $row["numbyes"];?></td>
            <td><?php echo $row["0"];?></td>
            <td><?php echo $row["0"];?></td>
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