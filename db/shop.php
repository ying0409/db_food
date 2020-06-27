<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
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

$_input = 4;

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "<h1><b>$row[s_name]</b></h1><br>";
	}
}
echo '<img src = "hotpotIN.jpg"</img><br><br>';
echo '<b>相關資訊</b><br><br>';


echo '<table >';

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) 
{
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) 
	{
		echo '<a href = " ' . $row[website] . ' ">Website</a><br>';
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
//$result = mysql_query($query) or die('Query failed: ' . mysql_error());
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	echo '<tr>';
		echo '<td>Style  </td>';
		echo "<td>$row[style]<br></td>";
	echo '</tr>';
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	echo '<tr>';
		echo '<td>Phone  </td>';
		echo "<td>$row[phone]<br></td>";
	echo '</tr>';
	}
}

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	echo '<tr>';
		echo '<td>Address  </td>';
		echo "<td>$row[address]<br></td>";
	echo '</tr>';
	}
}


$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
	echo '<tr>';
		echo '<td>Star </td>';
		echo "<td>$row[star]<br></td>";
	echo '</tr>';
	}
}
echo '</table>';

?>	

	</ul>

	<button><a href="menu.php? num=<?=$_input?>" style="text-decoration:none;">菜單</a></button>
	<button><a href="time.php? num=<?=$_input?>" style="text-decoration:none;">營業時間</a></button>
	<button><a href="discount.php? num=<?=$_input?>" style="text-decoration:none;">優惠</a></button>
	<button><a href="comment.php?  num=<?=$_input?>"style="text-decoration:none;">評論</a></button>

</body>
