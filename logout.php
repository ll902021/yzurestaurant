<?php
//session
	// Sessions are always turned on
	if(!isset($_SESSION)){
		session_set_cookie_params(3600,'/');
		session_start();
	}
	
	unset($_SESSION['user_name']);
	setcookie(session_name(),'',time()-3600,'/');
	header("Location: https://yzurestmarking.sytes.net/explore.html");
	
	
?>
