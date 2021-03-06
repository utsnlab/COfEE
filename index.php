<?php session_start();
include 'header.php';
$error_message = "";
$using_lang = $_SESSION['using_lang'];

if(isset($_GET['action']) and $_GET['action'] == "logout"){
    unset($_SESSION['user']);
}
if(isset($_POST['submit'])){
    if(empty($_SESSION['captcha_code']) || empty($_SESSION['captcha_code']['login'] ) || strcasecmp($_SESSION['captcha_code']['login'], $_POST['captcha_code']) != 0){  
        $error_message="<span style='color:red'>The Validation code does not match!</span>";		
    }
    else{
        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);
        $u_id = $d->getrowvalue("id","select id from user where username = '".$username."' and password = '".$password."'",true);
        $ug_id = $d->getrowvalue("user_group","select user_group from user where username = '".$username."' and password = '".$password."'",true);
        $rtl = $d->getrowvalue("rtl","select rtl from user where username = '".$username."' and password = '".$password."'",true);
    }
    if(!empty($u_id)){
        $_SESSION['user']['id'] = $u_id;
        $_SESSION['user']['ug'] = $ug_id;
        $_SESSION['user']['rtl'] = $rtl;
    }elseif(empty($error_message)){
        $error_message = '<div class="alert alert-danger" role="alert">Incorrect Username or Password</div>';
    }
}
if(isset($_POST['register'])){
    
    if(empty($_SESSION['captcha_code']) || empty($_SESSION['captcha_code']['register'] ) || strcasecmp($_SESSION['captcha_code']['register'], $_POST['captcha_code']) != 0){  
        $error_message_register="<span style='color:red'>The Validation code does not match!</span>";		
    }
    
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    if (empty($error_message_register) && strpos($_POST['password'], '\\') === false) {
        if (strpos($_POST['username'], '\\') === false) {
            $u_id = $d->getrowvalue("id", "select id from user where username = '" . $username . "'", true);
            if (empty($u_id)) {
                $d->iquery("user", ['username' => $username, 'password' => $password, 'user_group' => 2]);
                $u_id = $d->insert_id();
                $defualt_user = $d->fetch($d->query("select * from user where username='admin'"));
                $defualt_user_id = 1;
                if(!empty($defualt_user)){
                    $defualt_user_id = $defualt_user['id'];
                }
                $q = $d->query("select * from events where u_id={$defualt_user_id} and parent is null");
                $events_data_for_insert = [];
                $events_columns = ['id', 'title', 'des', 'u_id', 'parent'];
                $events_max_id = $d->fetch($d->query('select max(id) as m from events')); 
                if(!empty($events_max_id))
                    $events_max_id = $events_max_id['m'];
                $arg_data_for_insert = [];
                $args_columns = ["id", "title", 'des', 'u_id', 'event_id'];
                $args_max_id = $d->fetch($d->query('select max(id) as m from arguments'));
                if(!empty($args_max_id))
                    $args_max_id = $args_max_id['m'];
                while($row = $d->fetch($q)){
                    //$d->iquery("events",["title"=>$row['title'],'des'=>$row['des'],'u_id'=>$u_id]);
                    $events_max_id+=1; 
                    $events_data_for_insert[]=['id'=>$events_max_id, 'title'=>$row['title'],
                    'des'=>$row['des'],'u_id'=>$u_id];
                    $parent_event_id = $events_max_id;
                    $qq = $d->query("select * from events where parent = ".$row['id']);
                    while($res = $d->fetch($qq)){
                        $events_max_id+=1;
                        $events_data_for_insert[]=["id"=>$events_max_id, "title"=>$res['title'],'des'=>$res['des'],'u_id'=>$u_id,
                        'parent'=>$parent_event_id];
                        //$d->iquery("events",["title"=>$res['title'],'des'=>$res['des'],'u_id'=>$u_id,'parent'=>$parent_event_id]);
                        $new_event_id = $events_max_id;
                        $qq_args = $d->query("select * from arguments where event_id = ".$res['id']);
                        while($arg = $d->fetch($qq_args)){
                            $args_max_id+=1;
                            //$d->iquery("arguments",["title"=>$arg['title'],'des'=>$arg['des'],'u_id'=>$u_id,'event_id'=>$new_event_id]);
                            $arg_data_for_insert[]=["id"=>$args_max_id, "title"=>$arg['title'],'des'=>$arg['des'],
                            'u_id'=>$u_id,'event_id'=>$new_event_id];
                        }
                    }
                }
                $d->bulk_insert('events', $events_columns, $events_data_for_insert);
                $d->bulk_insert('arguments', $args_columns, $arg_data_for_insert);
                $q = $d->query("select * from entities where u_id={$defualt_user_id} and parent is null");
                $entities_data_for_insert = [];
                $entities_columns = ["id", "title", 'des', 'u_id', 'parent'];
                $entities_max_id = $d->fetch($d->query('select max(id) as m from entities'))['m']; 
                while($row = $d->fetch($q)){
                    $entities_max_id+=1;
                    $entities_data_for_insert[]=["id"=>$entities_max_id,"title"=>$row['title'],'des'=>$row['des'],'u_id'=>$u_id];
                    $parent_entity_id = $entities_max_id;
                    //$d->iquery("entities",["title"=>$row['title'],'des'=>$row['des'],'u_id'=>$u_id]);
                    //$parent_entity_id = $d->insert_id();
                    $qq = $d->query("select * from entities where parent = ".$row['id']);
                    while($res = $d->fetch($qq)){
                        $entities_max_id+=1;
                        $entities_data_for_insert[]=["title"=>$res['title'],'des'=>$res['des'],'u_id'=>$u_id,
                        'parent'=>$parent_entity_id];
                        //$d->iquery("entities",["title"=>$res['title'],'des'=>$res['des'],'u_id'=>$u_id,'parent'=>$parent_entity_id]);
                    }
                }
                $d->bulk_insert('entities', $entities_columns, $entities_data_for_insert);
                $_SESSION['user']['id'] = $u_id;
                $_SESSION['user']['ug'] = 2;
                $_SESSION['user']['rtl'] = 0;
            } else {
                $error_message_register = '<div class="alert alert-danger" role="alert">Username exist.</div>';
            }
        }else{
            $error_message_register = '<div class="alert alert-danger" role="alert">Username can`t contain \.</div>';
        }
    }elseif(empty($error_message_register)){
        $error_message_register = '<div class="alert alert-danger" role="alert">Password can`t contain \.</div>';
    }
}
if(!(isset($_SESSION['user']['id']) and is_numeric($_SESSION['user']['id']))){
    $navigation = '
        <li class="nav-item">
            <a class="nav-link" href="/">Login</a>
        </li>
    ';
    include "login.php";
}else {
    $u_id = $_SESSION['user']['id'];
    $ug_id = $_SESSION['user']['ug'];
    $_SESSION['user']['rtl'] = $d->getrowvalue('rtl',"select rtl from user where id={$u_id}",true);
    $user_info_q = $d->query("select * from user where id = {$u_id}");
    $user_info = $d->fetch($user_info_q);
    if($ug_id > 2){
        $parent_id = $d->getrowvalue("parent","select parent from user where id=".$u_id,true);
    }
    if($ug_id == 1){
        $navigation = '
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=project">'.$PROJECTS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=users">'.$USERS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=entity">'.$ENTITIES[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=event">'.$EVENETS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=statistics">'.$STATISTICS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=settings">'.$SETTINGS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">'.$LOGOUT[$using_lang].'</a>
        </li>
    ';
    }elseif($ug_id == 2){
        $navigation = '
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=project">'.$PROJECTS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=users">'.$USERS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=entity">'.$ENTITIES[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=event">'.$EVENETS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=statistics">'.$STATISTICS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=settings">'.$SETTINGS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">'.$LOGOUT[$using_lang].'</a>
        </li>
    ';
    }else{
        $navigation = '
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=project">'.$PROJECTS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=statistics">'.$STATISTICS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=settings">'.$SETTINGS[$using_lang].'</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">'.$LOGOUT[$using_lang].'</a>
        </li>
    ';
    }

    $select_lang = array('en'=>'', 'fa'=>'');
    $select_lang[$using_lang]='selected';
    
    $navigation .= 
        "<select class='form-control lang_selector'>
            <option data-content='en' {$select_lang['en']}>en</option>
            <option  data-content='fa' {$select_lang['fa']}>fa</option>
        </select>
        ";
    $full_status = true;
    $limit_per_page = $user_info['limit_per_page'];
    $current_page = test_input($_GET['page']);
    if($current_page < 1) $current_page = 1;
    $start = ($current_page - 1) * $limit_per_page;
    if(isset($_GET['page']) and !is_numeric($_GET['page'])){
        $full_status = false;
    }
    if(isset($_GET['id']) and !is_numeric($_GET['id']) and $_GET['action'] != "tag"){
        $full_status = false;
    }
    if($full_status) {
        if (isset($_GET['action'])) {
            $action = test_input($_GET['action']);
            include $action . ".php";
            if (empty($content)) {
                $content = '<div class="alert alert-danger" role="alert">Permission Require</div>';
            }
        } else {
            $action = "project";
            include 'project.php';
        }
    }else{
        $content = '<div class="alert alert-danger" role="alert">Permission Require</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Text Annotation Tool</title>
    <?php if($_SESSION['user']['rtl']): ?>
        <link href="template/bootstrap/rtl/css/bootstrap.min.css" rel="stylesheet">
        <style>body{direction: rtl;}</style>
    <?php else: ?>
        <link href="template/bootstrap/ltr/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{direction: ltr;} 
            .modal { overflow: auto !important; }
        </style>
    <?php endif; ?>
    <link href="template/custom.css" rel="stylesheet">
    <script src="template/jquery/jquery.min.js"></script>
    <?php if($_SESSION['user']['rtl']): ?>
        <link rel="stylesheet" href="template/rightClick/jquery.contextMenu.min.css">
        <link rel="stylesheet" href="template/rightClick/jquery.contextMenuRtl.min.css">
        <script src="template/rightClick/jquery.contextMenu.min.js"></script>
        <script src="template/rightClick/jquery.contextMenuRtl.min.js"></script>
    <?php else: ?>
        <link rel="stylesheet" href="template/rightClick/jquery.contextMenu.min.css">
        <script src="template/rightClick/jquery.contextMenu.min.js"></script>
    <?php endif; ?>
    <script src="template/rightClick/jquery.ui.position.min.js"></script>
</head>
<body>
    <header>
        <style>
                .child > span > ul {
                    margin: 0; 
                    padding: 0;
                    list-style: none;
                    display: block;
                    float: none;
                }
                .child > span > ul > li {
                    display: inline-block;
                    border: 1px solid #CCC;
                    overflow: hidden;
                    margin: 2px;
                    padding: 1px;
                    
                }
                .child > span > ul > li:hover { border: 1px solid #000; }
        </style>
        
        <div class="container main-body">
            <div style="background-color:white; padding:5px;">
                    <h2>COfEE Annotation Tool</h2>
                    <p>A annotation tool for manual event extraction from text</p>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <?= $navigation ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="container main-body">
        <?= $content ?>
    </div>
    <?php if($_SESSION['user']['rtl']): ?>
        <script src="template/bootstrap/rtl/js/bootstrap.min.js"></script>
    <?php else: ?>
        <script src="template/bootstrap/ltr/js/bootstrap.min.js"></script>
    <?php endif; ?>
    <script src="template/custom.js?17"></script>
</body>
</html>