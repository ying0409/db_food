<html>
<head>
	<title>評論</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
<h1 align="center" style="margin-top: 25px">評論</h1>
<h2 align='center'><img style="margin-top: 5px" src="FOOD.gif" /></h2>
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

$s_id = $_GET['s_id'];
$c_id = $_GET['c_id'];

$is_exist=0;

echo "<h3 align='center'><font color='antiquewith'><a href = 'manager_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";

$query = "SELECT * FROM customer NATURAL JOIN shop NATURAL JOIN comment where s_id=$s_id";
echo "<table align='center' width='300' border='1'>";
echo "<tr><td>Name</td>";
echo "<td>Star</td>";
echo "<td>Commend</td></tr>";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "<tr><td>$row[c_name]</td>";
		echo "<td>";
		$is_exist=1;
		switch ($row[star]) {
			case 0:
				echo "☆☆☆☆☆";
				break;
			case 1:
				echo "★☆☆☆☆";
				break;
			case 2:
				echo "★★☆☆☆";
				break;
			case 3:
				echo "★★★☆☆";
				break;
			case 4:
				echo "★★★★☆";
				break;
			case 5:
				echo "★★★★★";
				break;
		}
		echo "</td><td>$row[content]</td></tr>";
	}
}
echo "</table><br><br>";

if($is_exist===0)
{
	echo "<h2 align='center'><font color='antiquewith'>目前尚無評論QQ<br> </font></h2>";
}

// echo "$c_id<br>";
// echo "$s_id<br>";
?>

	
</body>
	
</html>