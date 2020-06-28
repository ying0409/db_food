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

$_input = 5;
$_correct=TRUE;

if (isset($_POST['website']) &&  isset($_POST['style']) && isset($_POST['phone']) && isset($_POST['address'])) {
    //$photo = $_POST['photo']
    $website = $_POST['website'];
    $style = $_POST['style'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $update_shop="UPDATE shop SET website='$website',style='$style',phone='$phone',address='$address' WHERE s_id = '$_input'";
    if ($conn->query($update_shop) === FALSE) {
        echo "error:update shop";
        echo "<h2 align='center'><font color='antiquewith'>更新失敗!!</font></h2><br>
        <div align='center'>
        <a href='manager_exit_shop.php'><再試一次></a>
        <a href='manager_shop.php'><返回></a>
        </div>";
        $_correct=FALSE;
    } 

    //time
    $query = "SELECT * FROM time where s_id = '$_input'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
            $op_hr=$_POST["time-op_hr-$row[day]"];
            $op_min=$_POST["time-op_min-$row[day]"];
            $cl_hr=$_POST["time-cl_hr-$row[day]"];
            $cl_min=$_POST["time-cl_min-$row[day]"];
            $update_time="UPDATE time SET op_hr='$op_hr',op_min='$op_min',cl_hr='$cl_hr',cl_min='$cl_min'  WHERE day = '$row[day]' and s_id='$_input' ";
            if ($conn->query($update_time) === FALSE){
                echo 'error:time update';
                echo "<h2 align='center'><font color='antiquewith'>更新失敗!!</font></h2><br>
                <div align='center'>
                <a href='manager_exit_shop.php'><再試一次></a>
                <a href='manager_shop.php'><返回></a>
                </div>";
                $_correct=FALSE;
            }
        }
    }
    
    //menu
    if (isset($_POST['add_food_name']) &&  isset($_POST['add_food_price']))
    {
        $add_name=$_POST['add_food_name'];
        $add_price=$_POST['add_food_price'];
        $insert_menu="INSERT into menu(s_id,d_name,price) values('$_input','$add_name','$add_price') ";
        if ($conn->query($insert_menu) === FALSE){//error
            echo 'no insert menu';
            $_correct=FALSE;
        }
    }else{
        echo "data lost:add menu";
        $_correct=FALSE;
    }
    
    if(isset($_POST['delete_food_name']))
    {
        $delete_name=$_POST['delete_food_name'];
        $delete_menu="DELETE FROM menu where d_name='$delete_name' and s_id='$_input'"; 
        if ($conn->query($delete_menu) === FALSE){
            echo 'no delete menu';
            $_correct=FALSE;
        }
    }else{
        echo "data lost:delete menu";
        $_correct=FALSE;
    }
    
    //discount
    if (isset($_POST['add_discount']))
    {
        $add_content=$_POST['add_discount'];
        $add_d_id=0;
        $found=FALSE;
        $query_d = "SELECT * FROM discount ";
        $result_d = $conn->query($query_d);
        if ($result_d->num_rows > 0) {
            while($found == FALSE)
            {
                $add_d_id=$add_d_id+1;
                $found=TRUE;
                while($row = mysqli_fetch_array ( $result_d, MYSQLI_ASSOC ) ) {
                    if($add_d_id == $row[d_id]){
                        $found=FALSE;
                        break;
                    }
                }
            }
        }
        $insert_discount="INSERT into discount values('$add_d_id','$add_content') ";
        if ($conn->query($insert_discount) === TRUE){
            $insert_provide="INSERT into provide('s_id','d_id','t_id') values('$_input','$add_d_id','00000000') ";//t_id not done
            if($conn->query($insert_provide) === FALSE){
                echo'no insert provide';
                $_correct=FALSE;
            }
        }else{//error
            echo 'no insert discount';
            $_correct=FALSE;
        }

    }else{
        echo "data lost:add discount";
        $_correct=FALSE;
    }
    if(isset($_POST['delete_d_id']))
    {
        $delete_d_id=$_POST['delete_d_id'];
        $delete_discount="DELETE FROM discount where d_id='$delete_d_id' "; 
        if ($conn->query($delete_discount) === FALSE){
            echo 'no delete discount';
            $_correct=FALSE;
        }
    }else{
        echo "data lost:delete discount";
        $_correct=FALSE;
    }
    
    if($_correct === TRUE)
    {
        echo "<div align='center'><h3>已更新!</h3>
		<a href='manager_shop.php'>返回</a></div>";
    }
    else{
        echo "<h2 align='center'><font color='antiquewith'>更新錯誤!!</font></h2><br>
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

