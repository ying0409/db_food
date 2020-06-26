<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<ul>
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

$_input = 7;

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "<b>$row[name]</b><br>";
	}
}
echo '<img src = "hotpotIN.jpg"</img><br><br>';
echo '<b>相關資訊</b><br><br>';

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo '<a href = "$row[website]">Website</a><br>';
		echo "$row[website]<br>";
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
//$result = mysql_query($query) or die('Query failed: ' . mysql_error());
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Style:");
		echo "$row[style]";
		echo "<br>";
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Phone:");
	echo "$row[phone]";
	echo "<br>";
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Address:");
	echo "$row[address]";
	echo "<br>";
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Star:");
	echo "$row[star]";
	echo "<br>";
	}
}
?>
	</ul>
	
</body>