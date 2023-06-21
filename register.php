<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>學餐評價</title>
		<script>
			 window.alert( "註冊成功！請至學校信箱收信" );
			 window.location.href="https://yzurestmarking.sytes.net/signin.html";
		</script>
	</head>

	<body>
		<?php
			$C_nick=$_POST['nick'];
			$C_idnumber=$_POST['id'];
			$C_password=time();
			$C_signinnum=1;
			$password_hash=password_hash($C_password, PASSWORD_DEFAULT);
			
		//存資料
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

			$sql = "INSERT INTO `member` (`nick`, `idnumber`, `password`, `signinnum`)  values('$C_nick', '$C_idnumber','$password_hash','$C_signinnum')";
			$result = mysqli_query($link,$sql);

			mysqli_close($link);
			
			
		//寄信
			use PHPMailer\PHPMailer\PHPMailer;
			use PHPMailer\PHPMailer\Exception;

			require 'phpmailer/src/Exception.php';
			require 'phpmailer/src/PHPMailer.php';
			require 'phpmailer/src/SMTP.php';
			
			
			$mail= new PHPMailer();                          //建立新物件
			$mail->IsSMTP();                                    //設定使用SMTP方式寄信
			$mail->SMTPAuth = true;                        //設定SMTP需要驗證
			$mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
			$mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
			$mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
			$mail->CharSet = "utf-8";                       //郵件編碼
			$mail->Username = "yzurestmarking@gmail.com";          //Gamil帳號
			$mail->Password = "nbyjryztfkzuybxk";                 //Gmail密碼
			$mail->From = "yzurestmarking@gmail.com";        //寄件者信箱
			$mail->FromName = "元智大學學餐評分系統";     //寄件者姓名
			$mail->Subject ="歡迎使用元智大學學餐評分系統";                  //郵件標題
			$mail->Body = "感謝使用元智大學學餐評分系統，以下是您的註冊資訊<br>
						   <br>
						   暱稱：".$C_nick."<br>
						   帳號(學號)：".$C_idnumber."<br>
						   密碼：".$C_password."<br>
						   <br>
						   請使用上方密碼登入，第一次登入後須更改密碼<br>
						   若非本人註冊，請無視此信件，每整點清理未更改密碼之帳號";   //郵件內容
			$mail->IsHTML(true);                             //郵件內容為html
			$mail->AddAddress("s$C_idnumber@mail.yzu.edu.tw");            //收件者郵件及名稱
			if(!$mail->Send()){
				echo "Error: " . $mail->ErrorInfo;
			}
		?>
	</body>
</html>