<?php

// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "han186792435";
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

$_input = 4;

if (isset($_POST['website']) &&  isset($_POST['style']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['menu']) && isset($_POST['time']) && isset($_POST['discount'])) {
    //$photo = $_POST['photo']
    $website = $_POST['website'];
    $style = $_POST['style'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $menu = $_POST['menu'];
    $time = $_POST['time'];
    $discount = $_POST['discount'];


    $update_shop="UPDATE shop SET website='$website',style='$style',phone='$phone',address='$address' WHERE s_id = '$_input'";
    //$update_time="UPDATE time SET time=$time WHERE s_id = $_input";
    //$update_menu="UPDATE menu SET menu=$menu WhERE s_id = $_input";
    /*$update_discount="UPDATE discount SET content='$discount' WHERE d_id in (
        SELECT D.d_id
        FROM shop as S natural join provide as P natural join discount as D
        WHERE 
    )";*/

	if ($conn->query($update_shop) === TRUE) {
        echo "<div align='center'><h3>已更新!</h3>
		<a href='manager_shop.php'>返回</a></div>";
    } 
    else {
        echo "<h2 align='center'><font color='antiquewith'>更新失敗!!</font></h2><br>
        <div align='center'>
        <a href='manager_exit_shop.php'><再試一次></a>
        <a href='manager_shop.php'><返回></a>
        </div>";
	}
}
else{
	echo "資料不完全";
}
			
?>

