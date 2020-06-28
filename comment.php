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

echo "<h3 align='center'><font color='antiquewith'><a href = 'customer_shop.php? num=$s_id&my_id=$c_id'>回到店家資訊</a></font></h3>";

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
// echo "$c_id<br>";
// echo "$s_id<br>";
?>
	<style>
    input[type="submit"]{padding:5px 15px; background:#ccc; border:0 none;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
	
	input[type="button"]{padding:5px 15px; background:#ccc; border:0 none;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
    
    input[type="text"]{padding:5px 120px; border:2px black solid;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
	
	</style>
	<h3 align="center">新增評論</h3>
	<form action="add_comment.php" method="post">	
	<input type="hidden" name="c_id" value="<?php echo $c_id; ?>"	/>
	<input type="hidden" name="s_id" value="<?php echo $s_id; ?>"	/>
	<h3 align='center'><th>星級：</th>
	<input type="text" name="star"  />
	
	<h3 align='center'><th>評論：</th>
	<input type="text" name="content" /><br><br>
	<input type="submit" value="新增"/>

	</form>
	
</body>
	
</html>
