<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	
	<h3> 鍋IN</h3>
	<img src = "hotpotIN.jpg"</img>
	<h3> 相關資訊</h3>
	<ul>
		<li><a href = "https://reurl.cc/5ly93z">網站</a></li>
		<li>
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
$input=5;
$query = 'SELECT * FROM shop where s_id = 5';
$result = $link->query($query);
//$result = mysql_query($query) or die('Query failed: ' . mysql_error());
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Style:");
		echo "$row[style]";
		echo "<br>";
	}
}
$query = 'SELECT * FROM shop where s_id = 5';
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Phone:");
	echo "$row[phone]";
	echo "<br>";
	}
}

$query = 'SELECT * FROM shop where s_id = 5';
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Address:");
	echo "$row[address]";
	echo "<br>";
	}
}

$query = 'SELECT * FROM shop where s_id = 5';
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		printf("Star:");
	echo "$row[star]";
	echo "<br>";
	}
}

	?>
		  
		 </li>
	</ul>
	
</body>