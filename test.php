<?php	
	$host = 'localhost';
	$dbuser = 'collegeres';
	$dbpassword = 'collegeres';
	$dbname = 'collegeres';

	$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
	if($link){
		mysqli_query($link,"SET NAMES 'UTF8'");
		// echo "正確連接資料庫";
	}

	$sql = "SELECT sum(rating)/count(rating) as rate FROM `score` where choose='自助餐'";
	$result = mysqli_query($link,$sql);
	
	echo mysqli_num_rows($result);
	echo "</br>";
	
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "rate " . $row["rate"] . "<br>";
		}
	} else {
		echo "0 results";
	}
	
	mysqli_close($link);