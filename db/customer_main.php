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
<form action="create_account.php" method="post">
	<div class="demo">
    <input type="text" name='s_name' placeholder="輸入要搜尋的店家" >
    <input type="submit" value="搜尋店家">
	</div>


	<h3 align='center'>
	<th>價錢：</th>
	<select price="price">
		<option value="0">------------------</option>
　		<option value="50">50~100</option>
　		<option value="100">100~150</option>
　		<option value="150">150~200</option>
　		<option value="200">200~250</option>
		<option value="250">250~300</option>
	</select>
	<th>    </th>
	<th>風格：</th>
	<select style="style">
		<option value="no">------------------</option>
　		<option value="drink">drink</option>
　		<option value="100">hotpot</option>
　		<option value="150">日式</option>
　		<option value="200">美式</option>
		<option value="250">義式</option>
	</select>
	<th>營業時間：</th>
	<select style="style">
		<option value="no">------------------</option>
　		<option value="2">00:00~02:00</option>
　		<option value="4">02:00~04:00</option>
　		<option value="6">04:00~06:00</option>
　		<option value="8">06:00~08:00</option>
		<option value="10">08:00~10:00</option>
		<option value="12">10:00~12:00</option>
		<option value="14">12:00~14:00</option>
		<option value="16">14:00~16:00</option>
		<option value="18">16:00~18:00</option>
		<option value="20">18:00~20:00</option>
		<option value="22">20:00~22:00</option>
		<option value="0">22:00~00:00</option>
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

$file=fopen("my_id.txt","r");
$c_id=fgets($file);
fclose($file);

$query = "SELECT * FROM shop NATURAL JOIN favorate NATURAL JOIN customer WHERE c_id='$c_id'";
$result = $conn->query($query);
$count=0;
if ($result->num_rows > 0) {
	echo "<table align='center' width='300' border='1'>";
	while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
		if($count%2==0)echo "<tr>";
		echo "<td><a href = 'customer_shop.php'><b>$row[s_name]</b></a></td>";
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
			echo "<td><a href = 'customer_shop.php'><b>$row[s_name]</b></a></td>";
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
