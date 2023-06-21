<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>學餐評價</title>
		<script>
			 window.alert( "感謝您的回饋！" );
			 window.location.href="https://yzurestmarking.sytes.net/explore.html";
		</script>
	</head>

	<body>
		<?php
			$C_username=$_POST['username'];
			$C_email=$_POST['email'];
			$C_opinion=$_POST['opinion'];
			
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
			$mail->Subject ="回饋來信";                  //郵件標題
			$mail->Body = "來自 ".$C_username." 的回饋<br>
						   <br>
						   內容：<br> ".$C_opinion." <br>
						   <br>
						   回覆信箱：".$C_email." ";   //郵件內容
			$mail->IsHTML(true);                             //郵件內容為html
			$mail->AddAddress("yzurestmarking@gmail.com");            //收件者郵件及名稱
			if(!$mail->Send()){
				echo "Error: " . $mail->ErrorInfo;
			}
		?>
	</body>
</html>