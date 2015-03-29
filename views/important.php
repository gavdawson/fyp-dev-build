// SQL for all playero info plus the count of tournaments and possibily the total points (TRP to be confirmed if this is points)
$sql = "SELECT * FROM playero, (SELECT DISTINCT playerid, count(tournid) AS tourncount, TRP AS trptotal FROM `rpointso` GROUP BY playerid) tmp WHERE playero.playerid = tmp.playerid";

<th>
    			<a href="?orderby=tourncount<?php echo $orderby == 'tourncount' && $sort != 'DESC' ? '&sort=desc' : '';?>">Tournament count</a>
    		</th>
    		<th>
    			Total Points
    		</th>

    		<td><?php echo $row["tourncount"];?></td>
        	<td><?php echo $row["trptotal"];?></td>