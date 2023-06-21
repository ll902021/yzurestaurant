<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學餐評價</title>
	<script>
         window.alert( "提交成功！" );
		 window.location.href="https://yzurestmarking.sytes.net/explore.html";
    </script>
</head>

<body>
<?php

//存資料
	$C_name=$_POST['username'];
	$C_idnumber=$_POST['id'];
	$C_choose=$_POST['rating'];
	$C_rating=$_POST['ratescore'];
	$C_opinion=$_POST['opinion'];
	
	/*echo "username:$C_name";
	echo "id:$C_idnumber";
	echo "phone:$C_phone";
	echo "choose:$C_choose";
	echo "ratescore:$C_rating";
	echo "opinion:$C_opinion";*/
	
	$host = 'localhost';
	$dbuser = 'collegeres';
	$dbpassword = 'collegeres';
	$dbname = 'collegeres';

	$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
	if($link){
		mysqli_query($link,'SET NAMES "UTF8MB4"');
		// echo "正確連接資料庫";
	}
	else {
		echo "不正確連接資料庫</br>" . mysqli_connect_error();
	}

	$sql = "INSERT INTO `score` (`name`, `idnumber`, `choose`, `rating`, `opinion`)  values('$C_name', '$C_idnumber','$C_choose','$C_rating','$C_opinion')";
	$result = mysqli_query($link,$sql);

	mysqli_close($link);
?>
</body>
</html>