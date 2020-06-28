<html>
<head>
	<title>評論</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h2 align='center'><img style="margin-top: 5px" src="FOOD.gif" /></h2>
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

$s_id = $_GET['s_id'];
$c_id = $_GET['c_id'];

echo "<h1 ><font color='antiquewith'>評論<br> </font></h1>";
$query = "SELECT * FROM shop NATURAL JOIN comment where s_id=$s_id";
$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		echo "Star: ";
		echo "$row[star] ";
		echo "Comment: ";
		echo "$row[content]   <br><br>";
	}
}
// echo "$c_id<br>";
// echo "$s_id<br>";
?>
	<h3 align="center">新增評論</h3>
	<form action="add_comment.php" method="post">	
	<input type="hidden" name="c_id" value="<?php echo $c_id; ?>"	/>
	<input type="hidden" name="s_id" value="<?php echo $s_id; ?>"	/>
	  <table width="500" border="1" bgcolor="#cccccc" align="center">
		<tr>
		  <th>星級</th>
		  <td bgcolor="#FFFFFF"><input type="text" name="star"  /></td>
		</tr>
		<tr>
		  <th>評論</th>
		  <td bgcolor="#FFFFFF"><input type="text" name="content" /></td>
		</tr>
		<tr>
		  <th colspan="2"><input type="submit" value="新增"/></th>
		</tr>
	  </table>
	</form>
	
</body>
	
</html>




