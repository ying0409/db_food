<?php

$servername = "localhost";
$username = "root";
$password = "han186792435";
$dbname = "db_food";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/***************************/

$_S_ID=0;
$_M_ID = $_GET['my_id'];
$_CORRECT=TRUE;

//shop
if (isset($_POST['s_name']) && isset($_POST['photo']) && isset($_POST['website']) &&  isset($_POST['style']) && isset($_POST['phone']) && isset($_POST['address'])) {
    $s_name=$_POST['s_name'];
    $photo = $_POST['photo'];
    $website = $_POST['website'];
    $style = $_POST['style'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    //read file
    $file=fopen("count_shop.txt","r");
    $_S_ID=fgets($file);
    fclose($file);
    //
    $insert_shop="INSERT INTO shop (`s_id` , `m_id`, `s_name`, `style`, `phone`, `photo`, `website`, `address`, `aveprice`) VALUES
    ('$_S_ID' ,'$_M_ID', '$s_name','$style','$phone','$photo','$website' ,'$address', '')";//aveprice???
    if ($conn->query($insert_shop) === TRUE) {
        //write file
        $file=fopen("count_shop.txt","w");
        fwrite($file,$_S_ID+1);
        fclose($file);
        //
    }
    else{
        echo "error:update shop";
        $_CORRECT=FALSE;
    }
}
else{
    echo "lost data:shop";
}

//time
$t_count=1;
while($t_count<=7)
{
    if (isset($_POST["time-op_hr-$t_count"]) &&  isset($_POST["time-op_min-$t_count"]) && isset($_POST["time-cl_hr-$t_count"]) && isset($_POST["time-cl_min-$t_count"])) {
        $ophr=$_POST["time-op_hr-$t_count"];
        $opmin=$_POST["time-op_min-$t_count"];
        $clhr=$_POST["time-cl_hr-$t_count"];
        $clmin=$_POST["time-cl_min-$t_counti"];
        $insert_time="INSERT INTO time (`s_id`,`day`,`op_hr`,`op_min`,`cl_hr`,`cl_min`) VALUES
        ('$_S_ID' ,'$t_count', '$ophr', '$opmin','$clhr','$clmin')";
        if ($conn->query($insert_time) === FALSE) {
            echo "error:update time";
            $_CORRECT=FALSE;
        }
    }
    else{
        echo "lost data:time";
        $_CORRECT=FALSE;
        break;
    }
    $t_count+=1;
}

//menu
$menu_num=$_GET['menu_num'];
$menu_i=1;
while($menu_i<=$menu_num)
{
    if (isset($_POST["menu_name_$menu_i"]) &&  isset($_POST["menu_price_$menu_i"]))
    {
        $menu_name=$_POST["menu_name_$menu_i"];
        $menu_price=$_POST["menu_price_$menu_i"];
        $insert_menu="INSERT into menu(`s_id`,`d_name`,`price`) values('$_S_ID','$menu_name','$menu_price') ";
        if ($conn->query($insert_menu) === FALSE){
            echo 'no insert menu';
            //echo "<h3></h3>";
            $_CORRECT=FALSE;
        }
    }
    else
    {
        echo "data lost: menu";
        $_CORRECT=FALSE;
        break;
    }
    $menu_i+=1;
}


//discount
/*if (isset($_POST['add_discount'])&&isset($_POST['add_provide']))
{
    $add_content=$_POST['add_discount'];
    $add_time=$_POST['add_provide'];
    //read file
    $file=fopen("count_discount.txt","r");
    $$add_d_id=fgets($file);
    fclose($file);
    //
    $insert_discount="INSERT into discount(`d_id`,`content`) values('$add_d_id','$add_content') ";
    if ($conn->query($insert_discount) === TRUE){
        $insert_provide="INSERT into provide(`s_id`,`d_id`,`t_id`) values('$_S_ID','$add_d_id','$add_time') ";
        if($conn->query($insert_provide) === TRUE){
            //write file
            $add_d_id+=1;
            $file=fopen("count_discount.txt","w");
            fwrite($file,$add_d_id);
            fclose($file);
            //
        }
        else{
            echo'no insert provide';
            $_CORRECT=FALSE;
        }
    }else{//error
        echo "no insert discount ";
        echo "<h3>$add_d_id</h3>";
        $_CORRECT=FALSE;
    }

}else{
    echo "data lost:add discount";
    $_CORRECT=FALSE;
}
*/

if($_CORRECT === TRUE)
{
    echo "<div align='center'><h3>新增成功!</h3>";
    echo "<a href='manager_shop.php? num=$_S_ID&my_id=$_M_ID'><前往店家頁面></a>";
    echo "<a href='manager_main.php? my_id=$_M_ID'><返回首頁></a></div>";
}
else{
    echo "<h2 align='center'><font color='antiquewith'>更新錯誤!!</font></h2><br>
    <div align='center'>
    <a href='manager_add_shop.php? my_id=$_M_ID'><再試一次></a>
    <a href='manager_main.php? my_id=$_M_ID'><返回首頁></a>
    </div>";
}

			
?>

