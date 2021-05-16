<?php
	session_start();
	include("./phptextClass.php");	
	
	/*create class object*/
	$phptextObj = new phptextClass();
	$captcha_name = $_GET['captcha_name'];
	/*phptext function to genrate image with text*/
	$phptextObj->phpcaptcha($captcha_name, '#162453','#ffffff',120,40,10,25);	
 ?>