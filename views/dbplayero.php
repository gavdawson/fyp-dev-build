<?php
$servername 	= "localhost";
$username 		= "root";
$password 		= "mysql";
$dbname 		= "absporgu_membership";
$orderby 		= '';
$sort 			= '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Initial SQL Query
// $sql = "SELECT * FROM playero";

// SQL for all playero info plus the count of tournaments and possibily the total points (TRP to be confirmed if this is points)
$sql = "SELECT * FROM playero, (SELECT DISTINCT playerid, count(tournid) AS tourncount, TRP AS trptotal FROM `rpointso` GROUP BY playerid) tmp WHERE playero.playerid = tmp.playerid";

// SQL for total matches played (not joined or as variable):
// "SELECT DISTINCT playerid, sum(counttournid) as sumcounttourndid FROM (SELECT * FROM (SELECT DISTINCT playerid, count(tournid) as counttournid FROM `ratedmatches` GROUP BY playerid) t1 UNION SELECT * FROM (SELECT DISTINCT oppoid, count(tournid) as counttournid FROM `ratedmatches` GROUP BY oppoid) t2) t3 GROUP BY playerid"

// $total_matches_played 			= "SELECT DISTINCT playerid, sum(counttournid) as sumcounttourndid FROM (SELECT * FROM (SELECT DISTINCT playerid, count(tournid) as counttournid FROM `ratedmatches` GROUP BY playerid) t1 UNION SELECT * FROM (SELECT DISTINCT oppoid, count(tournid) as counttournid FROM `ratedmatches` GROUP BY oppoid) t2) t3 GROUP BY playerid";
// $total_tournaments_and_points 	= "SELECT DISTINCT playerid, count(tournid) as tourncount, TRP as trptotal FROM `rpointso` GROUP BY playerid";
// $totals_join 					= "SELECT * FROM  (" . $total_matches_played . ") total_matches_played (" . $total_tournaments_and_points . ") total_tournaments_and_points,  WHERE total_matches_played.playerid = total_tournaments_and_points.playerid";
// $sql_join 						= "SELECT * FROM playero, (". $totals_join .") totals_join WHERE playero.playerid = totals_join.playerid";

// $sql 							= $sql_join;

// Do the orderby
// If the orderby querystring is set
if( isset( $_GET['orderby'] ) ) {

	// Init the sort order
	$sort 		= 'ASC';
	$orderby 	= $_GET['orderby'];

	// if the query sort is set (which will always only be desc), set the order to DESC
	if( isset( $_GET['sort'] ) && $_GET['sort'] == 'desc' ) {
		$sort = 'DESC';
	}

	// Append to the SQL Query
	$sql .= " ORDER BY " . $orderby . " " . $sort;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	?>
    <table style="border: 1px solid black;">
    	<tr>
    		<th>
    			<a href="?orderby=membno<?php echo $orderby == 'membno' && $sort != 'DESC' ? '&sort=desc' : '';?>">Member Number</a>
    		</th>
    		<th>
    			<a href="?orderby=nameComposite<?php echo $orderby == 'nameComposite' && $sort != 'DESC' ? '&sort=desc' : '';?>">Name</a>
    		</th>
    		<th>
    			<a href="?orderby=surname<?php echo $orderby == 'surname' && $sort != 'DESC' ? '&sort=desc' : '';?>">Surname</a>
    		</th>
    		<th>
    			<a href="?orderby=forenames<?php echo $orderby == 'forenames' && $sort != 'DESC' ? '&sort=desc' : '';?>">Forenames</a>
    		</th>
    		
    	</tr>
    <?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	?>
        <tr>
        	<td><?php echo $row["membno"];?></td>
        	<td><?php echo $row["nameComposite"];?></td>
        	<td><?php echo $row["surname"];?></td>
        	<td><?php echo $row["forenames"];?></td>
        	
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
} else {
	?>
	<p>0 results</p>
	<?php
}
$conn->close();
?>