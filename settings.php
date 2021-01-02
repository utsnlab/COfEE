<?php
if(isset($_POST['submit'])){
    $limit_per_page = test_input($_POST['limit_per_page']);
    if($limit_per_page > 200) $limit_per_page = 200;
    $rtl = test_input($_POST['rtl']);
    if(empty($rtl)) $rtl = 0;
    $_SESSION['user']['rtl'] = $rtl;
    $d->uquery("user",['rtl'=>$rtl,'limit_per_page'=>$limit_per_page],"id=".$u_id);
    if($rtl){
        $rtl = "checked";
    }else{
        $rtl = "";
    }
}else{
    if($user_info['rtl']){
        $rtl = "checked";
    }else{
        $rtl = "";
    }
}
$content = file_get_contents($action . ".html");
$content = str_replace(['[-checked-]','[-limit_per_page-]'], [$rtl,$limit_per_page], $content);