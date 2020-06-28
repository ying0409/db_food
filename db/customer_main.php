<html>
<head>
	<title>學生資料庫管理系統</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="UTF-8">
    <title>Untitled Document</title>
    
<style>
    input[type="submit"]{padding:8px 15px; background:#ccc; border:0 none;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
    
    input[type="text"]{padding:8px 280px; border:2px black solid;
	cursor:pointer;
	-webkit-border-radius: 5px;
	border-radius: 5px; }
	
	.demo{
	padding-top: 20px;
	text-align: center
	}
</style>
</head>
<body bgcolor="#FFFAFA">
<?php
$my_id=$_GET["my_id"];
echo "<h3>$my_id</h3>";
//echo "<form action='select_shop.php?my_id=$my_id' method="post">";
?>
	<form action='select_shop.php?my_id=<?=$my_id?>' method="post">
	<div class="demo">
    <input type="text" name='s_name' placeholder="輸入要搜尋的店家" >
    <input type="submit" value="搜尋店家">
	</div>
	<h3 align='center'>
	<th>價錢：</th>
	<select name="price">
		<option value="0">------------------</option>
　		<option value="50">50~99</option>
　		<option value="100">100~149</option>
　		<option value="150">150~199</option>
　		<option value="200">200~249</option>
		<option value="250">250~299</option>
	</select>
	<th>    </th>
	<th>風格：</th>
	<select name="style">
		<option value="no">------------------</option>
　		<option value="drink">drink</option>
　		<option value="100">hotpot</option>
　		<option value="150">日式</option>
　		<option value="200">美式</option>
		<option value="250">義式</option>
	</select>
	<th>營業時間：</th>
	<select name="day">
		<option value="0">------------------</option>
　		<option value="1">星期一</option>
　		<option value="2">星期二</option>
　		<option value="3">星期三</option>
　		<option value="4">星期四</option>
		<option value="5">星期五</option>
		<option value="6">星期六</option>
		<option value="7">星期日</option>
	</select>
	<select name="time">
		<option value="24">------------------</option>
　		<option value="0">00:00~01:59</option>
　		<option value="2">02:00~04:59</option>
　		<option value="4">04:00~06:59</option>
　		<option value="6">06:00~08:59</option>
		<option value="8">08:00~10:59</option>
		<option value="10">10:00~12:59</option>
		<option value="12">12:00~14:59</option>
		<option value="14">14:00~16:59</option>
		<option value="16">16:00~18:59</option>
		<option value="18">18:00~20:59</option>
		<option value="20">20:00~22:59</option>
		<option value="22">22:00~00:59</option>
	</select>
	</h3>
</form>
	<h2 align='center'><img src="FOOD.gif" /></h2>
<ul>
<?php

//******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "cindy88409";
$dbname = "db_food";

// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM shop NATURAL JOIN favorate NATURAL JOIN customer WHERE c_id=$my_id";
$result = $conn->query($query);
$count=0;
if ($result->num_rows > 0) {
	echo "<table align='center' width='300' border='1'>";
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		if($count%2==0)echo "<tr>";
		echo "<td><a href='customer_shop.php? num=$row[s_id]&my_id=$my_id'<b>$row[s_name]</b></a></td>";
		echo "<td><img src='$row[photo]' width='500' height='300'/></img></td>";
		$count+=1;
		if($count%2==0){
			$count=0;
			echo "</tr>";
		}
	}	
	echo "</table>";
}		
else{
	echo "<h2 align='center'><font color='antiquewith'>您還未收藏任何店家！以下為您提供所有店家列表...</font></h2>";
	$query = "SELECT * FROM shop";
	$result = $conn->query($query);
	$count=0;
	if ($result->num_rows > 0) {
		echo "<table align='center' width='300' border='1'>";
		while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
			if($count%2==0)echo "<tr>";
			echo "<td><a href = 'customer_shop.php? num=$row[s_id]&my_id=$my_id'><b>$row[s_name]</b></a></td>";
			echo "<td><img src='$row[photo]' width='500' height='300'/></img></td>";
			$count+=1;
			if($count%2==0){
				$count=0;
				echo "</tr>";
			}
		}		
		echo "</table>";
	}
}
?> 
</ul>

</body>
</html>
