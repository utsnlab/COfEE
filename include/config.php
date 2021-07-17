<?php
error_reporting('0');
if ( !defined('news_security'))
{
 die("You are not allowed to access this page directly!");
}
$dbconfig   = array(
'hostname'  => 'db',
'username'  => 'root',
'password'  => 'root123',
'perfix'    => '',
'database'  => 'annotate_data'
);
$perfix = $dbconfig['perfix'];
//Select database
$d = new dbclass();
$d->mysql($dbconfig['hostname'],$dbconfig['username'],$dbconfig['password'],$dbconfig['database']);
$d->query("SET CHARACTER SET utf8;");
$d->query("SET SESSION collation_connection = 'utf8_general_ci'");
function safeinturl($url){
return $url;
}
?>
