<?php
$servername = "localhost";
$username = "root";
$password = "cindy88409";
$dbname = "db_food";

// Connecting to and selecting a MySQL database
$link = new mysqli($servername, $username, $password, $dbname);


if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
}

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 

$_input = $_GET["num"];
echo "Menu<br>";
$query = "SELECT * FROM shop NATURAL JOIN menu where s_id= $_input";
$result = $link->query($query);
echo '<table >';
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	echo '<tr>';
		echo "<td>$row[d_name]</td>";
		echo "<td>$row[price]<br></td>";
	echo '</tr>';
	}
}
echo '</table >';
?>