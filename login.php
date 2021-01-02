<?php
$content = file_get_contents("login.html");
$content = str_replace(['[-error_message-]','[-error_message_register-]'],[$error_message,$error_message_register],$content);