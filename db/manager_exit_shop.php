<html>

<head>
	<title>美食地圖</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		input[type="submit"] {
			padding: 5px 15px;
			background: #ccc;
			border: 0 none;
			cursor: pointer;
			-webkit-border-radius: 5px;
			border-radius: 5px;
		}

		input[type="button"] {
			padding: 5px 15px;
			background: #ccc;
			border: 0 none;
			cursor: pointer;
			-webkit-border-radius: 5px;
			border-radius: 5px;
		}
	</style>
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
        /**************************/
        $S_ID='5';
        $shop_query ="SELECT * FROM shop WHERE s_id='$S_ID'";
        $shop_result = $conn->query($shop_query);
        if ($shop_result->num_rows > 0) 
        {
            $row = mysqli_fetch_array ( $shop_result, MYSQLI_ASSOC );
            $website_value=$row[website];
            $style_value=$row[style];
            $phone_value=$row[phone];
            $address_value=$row[address];
        }
        //ex:name='menu_name_$count."'
        $menu_query ="SELECT * FROM menu WHERE s_id='$S_ID'";
        $menu_result = $conn->query($menu_query);
        if ($menu_result->num_rows > 0) 
        {
            $menu_value='<tr><td>Name</td><td>Price</td><tr>';
            //$count=1;
            while($row = mysqli_fetch_array ( $menu_result, MYSQLI_ASSOC ) ) {
                //$menu_value=$menu_value.'/ '.$row[d_name].':'.$row[price];
                $menu_value=$menu_value."<tr><td>".$row[d_name]."</td><td>";//<input type='text' value='".$row[d_name]."' name='menu_name_".$count."'/></td>";
                $menu_value=$menu_value."<td>".$row[price]."</td></tr>";//<td><input type='text' value='".$row[price]."' name='menu_price_".$count."'/></td></tr>";
                //$count=$count+1;
            }/**/
        }
        //ex:name='time-op_hr-1'
        $time_query ="SELECT * FROM time WHERE s_id='$S_ID'";
        $time_result = $conn->query($time_query);
        if ($time_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $time_result, MYSQLI_ASSOC ) ) {
                $time_value=$time_value."<tr><td>星期".$row[day].":open</td>";
                $time_value=$time_value."<td><input type='text' value='".$row[op_hr]."' name='time-op_hr-".$row[day]."'/></td><td>:</td>";
                $time_value=$time_value."<td><input type='text' value='".$row[op_min]."' name='time-op_min-".$row[day]."'/></td><td>~</td>";
                $time_value=$time_value."<td><input type='text' value='".$row[cl_hr]."' name='time-cl_hr-".$row[day]."'/></td><td>:</td>";
                $time_value=$time_value."<td><input type='text' value='".$row[cl_min]."' name='time-cl_min-".$row[day]."'/></td></tr>";
            }
        }
        //discount_1
        $discount_query ="SELECT * FROM discount WHERE d_id in (
            SELECT D.d_id
            FROM provide as P natural join discount as D
            WHERE P.s_id='$S_ID'
        )";
        $discount_result = $conn->query($discount_query);
        if ($discount_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $discount_result, MYSQLI_ASSOC ) ) {
                //$discount_value=$discount_value.'/ '.$row[content];
                $discount_value=$discount_value."<tr><td>[ID:".$row[d_id]."]</td><td>Content:".$row[content]."</td></tr>";
            }
        }
             

    ?>
	<script type="text/javascript">
	    function init()
		{
            //var name='website';
            //slocation.href='m_exit_shop2.php?name='+name;
            var website_value="<?php echo $website_value; ?>";//alert(website_value);
            document.getElementById("website").value=website_value;

            //style
            var style_value="<?php echo $style_value; ?>";
            document.getElementById("style").value=style_value;

            //phone
            var phone_value="<?php echo $phone_value; ?>";
            document.getElementById("phone").value=phone_value;

            //address
            var address_value="<?php echo $address_value; ?>";
            document.getElementById("address").value=address_value;

            //menu
            var menu_value="<?php echo $menu_value; ?>";
            //alert(menu_value);
            document.getElementById("menu").innerHTML = menu_value;


            //time
            var time_value="<?php echo $time_value; ?>";
            //alert(time_value);
            document.getElementById("time").innerHTML = time_value;

            //discount
            var discount_value="<?php echo $discount_value; ?>";
            document.getElementById("discount").innerHTML =discount_value;
		}
	</script>
</head>

<body onload="init()">

    <h1 align="center" style="margin-top: 25px">編輯</h1>
    
    <div style="margin:0px auto; width:80%;">
        <h2 align='center'><img style="margin-top: 15px" src="FOOD.gif" /></h2>

        <form action="manager_update.php" method="post">
            <div style="margin:0px auto;width:80%;">
                <h2 align="center" style="margin-top: 25px">基本資料</h2>
                <table  align="center">
                    <tr>
                        <td>Website</td>
                        <td><input type="text" class="basis_input" id="website" name="website" /></td>
                    </tr>
                    <tr>
                        <td>style</td>
                        <td><input type="text" class="basis_input" id="style" name="style" /></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" class="basis_input" id="phone" name="phone" /></td>
                    </tr>
                    <tr">
                        <td>Address</td>
                        <td><input type="text" class="basis_input" id="address" name="address" /></td>
                    </tr>
                </table>
            </div>

            <hr>
            <h2 align='center' style="margin-top: 25px">菜單</h2>
            <table id="menu" align='center'></table>
            <table align='center' style="margin-top: 15px">
                <tr>
                    <td>新增一道菜=></td>
                    </td>
                    <td>Name:<input type="text" name="add_food_name" /></td><td> Price:<input type="text" name="add_food_price" /></td> 
                </tr>
                <tr>
                    <td>刪除一道菜=></td>
                    <td>Name:<input type="text" name="delete_food_name" /></td><td> </td>
                </tr>
            </table>

            <hr>
            <h2 align='center' style="margin-top: 25px">營業時間</h2>
            <table id="time" align='center'></table>
            

            <hr>
            <h2 align='center' style="margin-top: 25px">優惠活動</h2>
            <table id="discount" align='center'></table>
            <table align='center' style="margin-top: 15px">
                <tr>
                    <td>新增優惠活動=></td>
                    <td>輸入活動內容：</td>
                    <td><input type="text" name="add_discount" /></td> 
                </tr>
                <tr>
                    <td>刪除優惠活動=></td>
                    <td>輸入活動ID:</td>
                    <td><input type="text" name="delete_d_id" /></td>
                </tr>
            </table>

            <h3 align='center'>
                <input type="submit" value="更新" />
                <input type="button" onclick="javascript:location.href='manager_shop.php'" value="取消" />
            </h3>
        </form>
    </div>

</body>

</html>