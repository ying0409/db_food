<html>
<head>
	<title>美食地圖</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFAFA">
	<h1 align="center" style="margin-top: 25px">詳細資訊</h1>
	<h2 align='center'><img style="margin-top: 15px" src="FOOD.gif" /></h2>
<ul>
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

$my_id = $_GET["my_id"];
$_input = $_GET["num"];

$query = "SELECT * FROM shop where s_id = $_input";
$result = $link->query($query);
echo "<h3 align='center'><font color='antiquewith'><a href = 'customer_main.php?my_id=$my_id'>回到主畫面</a></font></h3>";
if ($result->num_rows > 0) {
	echo "<table align='center' width='300' border='1'>";
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "<tr><td><img src = '$row[photo]' width='500' height='300'></img></td>";
		echo "<td align='center'><h1><b>★☆$row[s_name]☆★</b></h1>";
		echo '<h2>相關資訊</h2>';
		echo '<table >';
		echo '<a href = " ' . $row[website] . ' ">Website</a>';
		echo '<tr>';
		echo '<td>風格：</td>';
		echo "<td>$row[style]<br></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>電話：</td>';
		echo "<td>$row[phone]<br></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>地址：</td>';
		echo "<td>$row[address]<br></td>";
		echo '</tr>';
		echo '<tr>';
		echo '<td>評價：</td>';
		echo "<td>$row[star]<br></td>";
		echo '</tr>';
		echo '</table><br>';
		echo "<button><a href='menu.php? num=$_input' style='text-decoration:none;'>菜單</a></button>";
		echo "<button><a href='time.php? num=$_input' style='text-decoration:none;'>營業時間</a></button>";
		echo "<button><a href='discount.php? num=$_input' style='text-decoration:none;'>優惠</a></button>";
		echo "<button><a href='comment.php?  num=$_input'style='text-decoration:none;'>評論</a></button>";
		echo "<br>";
		$favorite_sql = "SELECT * FROM favorate where c_id = $my_id and s_id = $_input";
		$temp = $link->query($favorite_sql);
		if ($temp->num_rows > 0) echo "<button><a href='favorite.php? my_id=$my_id&num=$_input' style='text-decoration:none;'>取消收藏此店家</a></button>";
		else echo "<button><a href='favorite.php? my_id=$my_id&num=$_input' style='text-decoration:none;'>收藏此店家</a></button>";
		echo "</td></tr>";
	}
	echo "</table>";
}
?>	

	</ul>



</body>