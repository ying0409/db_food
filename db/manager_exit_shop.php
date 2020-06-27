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

		input[type="text"] {
			padding: 5px 150px;
			border: 2px black solid;
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
        $S_ID='4';
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
       //
        $menu_query ="SELECT * FROM menu WHERE s_id='$S_ID'";
        $menu_result = $conn->query($menu_query);
        if ($menu_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $menu_result, MYSQLI_ASSOC ) ) {
                $menu_value=$menu_value.'/ '.$row[d_name].':'.$row[price];
            }
        }
        //
        $time_query ="SELECT * FROM time WHERE s_id='$S_ID'";
        $time_result = $conn->query($time_query);
        if ($time_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $time_result, MYSQLI_ASSOC ) ) {
                $time_value=$time_value.'/ '.$row[day].':'.$row[op_hr].':'.$row[op_min].'~'.$row[cl_hr].':'.$row[cl_min];
            }
        }
        //
        $discount_query ="SELECT * FROM discount WHERE d_id in (
            SELECT D.d_id
            FROM provide as P natural join discount as D
            WHERE P.s_id='$S_ID'
        )";
        $discount_result = $conn->query($discount_query);
        if ($discount_result->num_rows > 0) 
        {
            while($row = mysqli_fetch_array ( $discount_result, MYSQLI_ASSOC ) ) {
                $discount_value=$discount_value.'/ '.$row[content];
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
            document.getElementById("menu").value=menu_value;

            //time
            var time_value="<?php echo $time_value; ?>";
            document.getElementById("time").value=time_value;

            //discount
            var discount_value="<?php echo $discount_value; ?>";
            document.getElementById("discount").value=discount_value;
		}
	</script>
</head>

<body onload="init()">

    <h1 align="center" style="margin-top: 25px">編輯</h1>
    
    <div style="margin:0px auto; width:80%;">
        <h2 align='center'><img style="margin-top: 15px" src="FOOD.gif" /></h2>

        <form action="manager_update.php" method="post">
            <h2 align='center' style="margin-top: 25px">基本資料</h2>
            <h3 align='center'>
                <th>Website</th>
                <input type="text"  id="website" name="website" />
            </h3>
            <h3 align='center'>
                <th>style</th>
                <input type="text" id="style" name="style" />
            </h3>
            <h3 align='center'>
                <th>Phone</th>
                <input type="text" id="phone" name="phone" />
            </h3>
            <h3 align='center'>
                <th>Address</th>
                <input type="text" id="address" name="address" />
            </h3>

            <hr>
            <h2 align='center' style="margin-top: 25px">菜單</h2>
            <h3 align='center'>
                <input type="text" id="menu" name="menu" />
            </h3>

            <hr>
            <h2 align='center' style="margin-top: 25px">營業時間</h2>
            <h3 align='center'>
                <input type="text" id="time" name="time" />
            </h3>

            <hr>
            <h2 align='center' style="margin-top: 25px">優惠活動</h2>
            <h3 align='center'>
                <input type="text" id="discount" name="discount" />
            </h3>


            <h3 align='center'>
                <input type="submit" value="更新" />
                <input type="button" onclick="javascript:location.href='manager_shop.php'" value="取消" />
            </h3>
        </form>
    </div>

</body>

</html>