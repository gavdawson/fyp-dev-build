<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absporgu_membership";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM playero";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Surname</th><th>Forenames</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["surname"]."</td><td>".$row["forenames"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>