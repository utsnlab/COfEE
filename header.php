<?php
	header("Content-Type: text/html; charset=utf-8");
	define("head",true);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('Asia/Tehran');
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    error_reporting(E_ALL);
	$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && ! in_array(strtolower($_SERVER['HTTPS']), array( 'off', 'no' ))) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	define('MAINPATH',dirname(__FILE__));
	define('news_security',true);
	include('include/db.php');
	include('include/config.php');
	include('include/pdate.php');
	include('include/jdf.php');
	include('include/functions.php');
	include('include/simple_html_dom.php');
	include('include/labels.php');
	if(empty($_SESSION['using_lang']))
		$_SESSION['using_lang'] = 'en';
