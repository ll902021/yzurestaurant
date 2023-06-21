<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>學餐評價</title>
		<script>
			function success(){
				window.alert( "更改成功！請重新登入" );
				window.location.href="https://yzurestmarking.sytes.net/signin.html";
			}
			
			window.addEventListener( "load", start, false );
		</script>
	</head>

	<body>
	<?php
		$C_idnumber=$_POST['id'];
		$C_oldpassword=$_POST['oldpassword'];
		$C_newpassword=$_POST['newpassword'];
		$password_hash=password_hash($C_newpassword, PASSWORD_DEFAULT);
		
	//存資料
		$host = 'localhost';
		$dbuser = 'collegeres';
		$dbpassword = 'collegeres';
		$dbname = 'collegeres';

		$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
		if($link){
			mysqli_query($link,'SET NAMES "UTF8MB4"');
		}
		else {
			echo "不正確連接資料庫</br>" . mysqli_connect_error();
		}
		
		$sql = "SELECT `idnumber`,`password` FROM `member`";
			$result = mysqli_query($link,$sql);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					if($C_idnumber == $row["idnumber"]){
						if (!password_verify($C_oldpassword,$row["password"])){
							echo '<script>', 'alert("密碼錯誤");', 'window.location.href="https://yzurestmarking.sytes.net/updatepw.html";', '</script>';
							exit;
						}
					}
				} 
			}
		
	//更新密碼
		$sql = "UPDATE `member` SET `password` = '$password_hash' where idnumber = '$C_idnumber'";
		$result = mysqli_query($link,$sql);
	
	//更新signinnum
		$sql = "UPDATE `member` SET `signinnum` = '2' where idnumber = '$C_idnumber'";
		$result = mysqli_query($link,$sql);
		
		mysqli_close($link);
		echo '<script>', 'success();', '</script>';
	?>
	</body>
</html>