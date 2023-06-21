<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>學餐評價</title>
		<script>
			 function first(){
				window.alert("第一次登入請更改密碼，否則帳號將在一小時內被清除");
				window.location.href="https://yzurestmarking.sytes.net/updatepw.html";
			 }
			 
			 function other(){
				window.alert("登入成功！");
				window.location.href="https://yzurestmarking.sytes.net/explore1.html";
			 }
			 
			 window.addEventListener( "load", start, false );
		</script>
	</head>

	<body>
		<?php
		//session
			if(!isset($_SESSION)){
				session_set_cookie_params(3600,'/');
				session_start();
			}
			
			$C_idnumber=$_POST['id'];
			$C_password=$_POST['password'];
			$_SESSION["user_name"] = $C_idnumber;
			
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
						if (!password_verify($C_password,$row["password"])){
							echo '<script>', 'alert("密碼錯誤");', 'window.location.href="https://yzurestmarking.sytes.net/signin.html";', '</script>';
							exit;
						}
					}
				} 
			}
			
			
			$sql = "SELECT `idnumber`,`signinnum` FROM `member`";
			$result = mysqli_query($link,$sql);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					if ($row["signinnum"] == 1){
						echo '<script>', 'first();', '</script>';
					}
					else {
						echo '<script>', 'other();', '</script>';
					}
				} 
			} 
			
			mysqli_close($link);
		?>
	</body>
</html>