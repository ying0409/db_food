<?php
$servername = "localhost";
$username = "root";
$password = "foodmap11";
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

$_input = 5;
echo "Discount<br>";
$query = "SELECT content from shop NATURAL JOIN provide NATURAL JOIN discount WHERE s_id = $_input;";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {

		echo "$row[content] <br>";
	}
}

?>