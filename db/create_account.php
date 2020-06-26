<?php

// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "cindy88409";
$dbname = "db_food";
$count=0;

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

if (isset($_POST['identity']) &&  isset($_POST['name']) && isset($_POST['account']) && isset($_POST['password']) && isset($_POST['email'])) {
	$identity = $_POST['identity'];
	$name = $_POST['name'];
	$account = $_POST['account'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	if($identity==0){
		$file=fopen("count_customer.txt","r");
		$count=fgets($file);
		fclose($file);
	}
	if($identity==1){
		$file=fopen("count_manager.txt","r");
		$count=fgets($file);
		fclose($file);
	}
	if($identity==1)$insert_sql = "INSERT INTO manager (m_id,name,account,password,email)VALUES('$count','$name','$account','$password','$email')";	// ******** update your personal settings ******** 
	if($identity==0)$insert_sql = "INSERT INTO customer (c_id,name,account,password,email)VALUES('$count','$name','$account','$password','$email')";	// ******** update your personal settings ******** 

	if ($conn->query($insert_sql) === TRUE) {
		$count+=1;
		if($identity==1){
			$file=fopen("count_manager.txt","w");
			fwrite($file,$count);
			fclose($file);
		}
		if($identity==0){
			$file=fopen("count_customer.txt","w");
			fwrite($file,$count);
			fclose($file);
		}
		echo "新增成功!!<br> <a href='register_new.html'>返回主頁</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>

