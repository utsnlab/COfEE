<?php session_start();
include 'header.php';
include './include/text_utils.php';
$using_lang = $_SESSION['using_lang'];
$using_key_lang = 'des';
if($using_lang == 'en'){
    $using_key_lang = 'title';
}
if(!isset($_SESSION['user'])){
    $res = ['status'=>false];
    echo json_encode($res);
    die();
}
$u_id = $_SESSION['user']['id'];
$user_name = $d->getrowvalue("username","select username from user where id={$u_id}",true);
$ug_id = (int)$_SESSION['user']['ug'];
if($ug_id > 2){
    $parent_id = $d->getrowvalue("parent","select parent from user where id=".$u_id,true);
}
$action = test_input($_REQUEST['action']);
switch ($action) {
    case 'add_project':
        if($ug_id < 3) {
            $title = test_input($_REQUEST['title']);
            $des = test_input($_REQUEST['des']);
            $user_num = test_input($_REQUEST['user_num']);
            $annotation_num = test_input($_REQUEST['annotation_num']);
            $rtl = test_input($_REQUEST['rtl']);
            if ($title != "" and is_numeric($user_num) and $user_num > 0) {
                if(empty($rtl)) {
                    $d->iquery('projects', ['title' => $title, 'des' => $des, 'user_num' => $user_num, 'annotation_num' => $annotation_num]);
                }else{
                    $d->iquery('projects', ['title' => $title, 'des' => $des, 'user_num' => $user_num, 'annotation_num' => $annotation_num, 'rtl' => $rtl]);
                }
                $project_id = $d->insert_id();
                $d->iquery('project_users', ['project' => $project_id, 'u_id' => $u_id]);
                if ($ug_id < 3) {
                    $add_user_button = '<button class="btn btn-sm btn-info" data-toggle="modal" data-project="' . $project_id . '" data-target="#setUser">Add User</button>';
                    $delete_button = '<button class="btn btn-sm btn-danger delete-rows" data-type="projects" data-id="' . $project_id . '">Delete</button>';
                    $export_button = '<a href="export.php?id='.$project_id.'" target="_blank" class="btn btn-sm btn-primary">Export</a>';
                }
                $res = [
                    'status' => true,
                    'html' => '
                <tr>
                    <td>' . $project_id . '</td>
                    <td>' . $title . '</td>
                    <td>' . $user_num . '</td>
                    <td>' . $annotation_num . '</td>
                    <td id="project'.$project_id.'" >' . $user_name . '</td>
                    <td>
                        ' . $add_user_button . '
                        <a href="index.php?action=phrases&id=' .$project_id . '" class="btn btn-sm btn-success">Annotate</a>
                        '.$export_button.'
                        ' . $delete_button . '
                    </td>
                </tr>
              '
                ];
            } else {
                $res = [
                    'status' => false,
                    'message' => '<div class="alert alert-danger" role="alert">Incorrect input parameters. Please Enter Title and User Number</div>'
                ];
            }
        }else{
            $res = [
                'status'=>false,
                'message' => '<div class="alert alert-danger" role="alert">You haven`t permission for add new project.</div>'
            ];
        }
        break;
    case 'add_user':
        if($ug_id > 2){
            $res = [
              'status'=>false,
              'meesage'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            $username = test_input($_REQUEST['username']);
            $password = test_input($_REQUEST['password']);
            $exist = $d->getrowvalue("id", "select id from user where username = '" . $username . "'", true);
            if (empty($exist)) {
                $d->iquery("user", ['username' => $username, 'password' => $password, 'parent' => $u_id, 'user_group' => 3]);
                $id = $d->insert_id();
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $id . '</td>
                        <td>' . $username . '</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="user" data-id="' . $id . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res = [
                    'message' => '<div class="alert alert-danger" role="alert">Please enter another username. This username is not available.</div>',
                    'status' => false
                ];
            }
        }
        break;
    case 'set_project_user':
        if($ug_id > 2){
            $res = [
                'message' => '<div class="alert alert-danger" role="alert">You haven`t permission for add new user for projects.</div>',
                'status' => false
            ];
        }else {
            $user = test_input($_REQUEST['user']);
            $project = test_input($_REQUEST['project']);
            //echo $user."-",$project."\n";
            if(empty($user) or empty($project) or !is_numeric($user) or !is_numeric($project)){
                $res = [
                    'message' => '<div class="alert alert-danger" role="alert">Input parameters is incorrect.</div>',
                    'status' => false
                ];
            }else {
                $exist = $d->getrowvalue("id", "select id from user where parent =" . $u_id . " and id=" . $user, true);
                if (empty($exist)) {
                    $res = [
                        'message' => '<div class="alert alert-danger" role="alert">Please Select Correct User.</div>',
                        'status' => false
                    ];
                } else {
                    $current_user = $d->getrowvalue("cnt", "select count(*) as cnt from project_users where project=" . $project, true);
                    $project_user_num = $d->getrowvalue("user_num", "select user_num from projects where id=" . $project, true);
                    $current_user = (int)$current_user;
                    $project_user_num= (int)$project_user_num;
                    if ($current_user < $project_user_num) {
                        if (empty($d->getrowvalue("project", "select project from project_users where project=" . $project . " and u_id=" . $user, true))) {
                            $d->iquery("project_users", ['u_id' => $user, 'project' => $project]);
                        }
                        $users = $d->getrowvalue("users", "select GROUP_CONCAT(user.username) as users from user,project_users where user.id = project_users.u_id and project = " . $project, true);
                        $res = [
                            'html' => $users,
                            'status' => true
                        ];
                    } else {
                        $res = [
                            'message' => '<div class="alert alert-danger" role="alert">The number of users has reached the limit.</div>',
                            'status' => false
                        ];
                    }
                }
            }
        }
        break;
    case 'get_user_statistics':
        $id = $_REQUEST['id'];
        $all_projects = $d->getrowvalue("cnt","select count(*) as cnt from project_users where u_id={$id}",true);
        $confirmed_annotate = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases_status where status =1 and u_id={$id}",true);
        $canceled_annotate = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases_status where  status =2 and u_id={$id}",true);
        $all_project_id = $d->getrowvalue("cnt","select group_concat(project separator ',') as cnt from project_users where u_id={$id}",true);
        $all_phrases = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases where project in({$all_project_id})",true);
        $res = [
            'status'=>true,
            'html'=>'
            <tr>
                <td>Projects</td>
                <td>'.$all_projects.'</td>
            </tr>
            <tr>
                <td>All Annotate</td>
                <td>'.$all_phrases.'</td>
            </tr>
            <tr>
                <td>Confirmed Annotate</td>
                <td>'.$confirmed_annotate.'</td>
            </tr>
            <tr>
                <td>Canceled Annotate</td>
                <td>'.$canceled_annotate.'</td>
            </tr>
            '
        ];
        break;
    case 'add_event':
        if($ug_id > 2){
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            $title = test_input($_REQUEST['title']);
            $des = test_input($_REQUEST['des']);
            if (!empty($title)) {
                $d->iquery("events", ['title' => $title, 'u_id' => $u_id, 'des' => $des]);
                $value = $d->insert_id();
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $value . '</td>
                        <td>' . $title . '</td>
                        <td>' . $des . '</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-parent="'.$value.'" data-target="#eventChildren">Children</button>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="events" data-id="' . $value . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res = [
                    'status'=>false,
                    'message'=>'<div class="alert alert-danger" role="alert">Title is required.</div>'
                ];
            }
        }
        break;
    case 'add_event_child':
        if($ug_id > 2){
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            $title = test_input($_REQUEST['title']);
            $des = test_input($_REQUEST['des']);
            $parent = test_input($_REQUEST['parent']);
            if (!empty($title) and is_numeric($parent) and !empty($parent)) {
                $d->iquery("events", ['title' => $title, 'u_id' => $u_id, 'des' => $des,'parent'=>$parent]);
                $value = $d->insert_id();
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $value . '</td>
                        <td>' . $title . '</td>
                        <td>' . $des . '</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-event="'.$value.'" data-target="#eventArguments">Arguments</button>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="events" data-id="' . $value . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res = [
                    'status'=>false,
                    'message'=>'<div class="alert alert-danger" role="alert">Title is required.</div>'
                ];
            }
        }
        break;
    case 'add_event_argument':
        if($ug_id > 2){
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            $title = test_input($_REQUEST['title']);
            $des = test_input($_REQUEST['des']);
            $event_id = test_input($_REQUEST['event_id']);
            if (!empty($title) and is_numeric($event_id) and !empty($event_id)) {
                $d->iquery("arguments", ['title' => $title, 'u_id' => $u_id, 'des' => $des,'event_id'=>$event_id]);
                $value = $d->insert_id();
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $value . '</td>
                        <td>' . $title . '</td>
                        <td>' . $des . '</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="events" data-id="' . $value . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res = [
                    'status'=>false,
                    'message'=>'<div class="alert alert-danger" role="alert">Title is required.</div>'
                ];
            }
        }
        break;
    case 'get_event_child':
        $parent = test_input($_REQUEST['parent']);
        if(!empty($parent) and is_numeric($parent)){
            $table = '';
            $q = $d->query("select * from events where parent={$parent}");
            while($row = $d->fetch($q)){
                $table .= '
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td contenteditable="true">' . $row['title'] . '</td>
                        <td contenteditable="true">' . $row['des'] . '</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#eventArguments" data-event="' . $row['id'] . '">Arguments</button>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="events" data-id="' . $row['id'] . '">Delete</button>
                            <button class="btn btn-sm btn-warning edit-rows" data-type="events" data-id="' . $row['id'] . '">Edit</button>
                        </td>
                    </tr>
                ';
            }
            $res = [
                'status'=>true,
                'html'=>$table
            ];
        }else{
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Incorrect Event.</div>'
            ];
        }
        break;
    case 'get_event_argument':
        $event_id = test_input($_REQUEST['event_id']);
        if(!empty($event_id) and is_numeric($event_id)){
            $table = '';
            $q = $d->query("select * from arguments where event_id={$event_id}");
            while($row = $d->fetch($q)){
                $table .= '
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td contenteditable="true">' . $row['title'] . '</td>
                        <td contenteditable="true">' . $row['des'] . '</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="arguments" data-id="' . $row['id'] . '">Delete</button>
                            <button class="btn btn-sm btn-warning edit-rows" data-type="arguments" data-id="' . $row['id'] . '">Edit</button>
                        </td>
                    </tr>
                ';
            }
            $res = [
                'status'=>true,
                'html'=>$table
            ];
        }else{
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Incorrect Event.</div>'
            ];
        }
        break;
    case 'add_entity':
        if($ug_id > 2){
            $res = [
              'status'=>false,
              'message'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            $title = test_input($_REQUEST['title']);
            $des = test_input($_REQUEST['des']);
            if (!empty($title)) {
                $d->iquery("entities", ['title' => $title, 'u_id' => $u_id, 'des' => $des]);
                $value = $d->insert_id();
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $value . '</td>
                        <td>' . $title . '</td>
                        <td>' . $des . '</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-entity="'.$value.'" data-target="#addEntityChildModal">Children</button>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="entities" data-id="' . $value . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res = [
                    'status'=>false,
                    'message'=>'<div class="alert alert-danger" role="alert">Title is required.</div>'
                ];
            }
        }
        break;
    case 'add_entity_child':
        if($ug_id > 2){
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            $title = test_input($_REQUEST['title']);
            $des = test_input($_REQUEST['des']);
            $parent = test_input($_REQUEST['parent']);
            if (!empty($title) and is_numeric($parent) and !empty($parent)) {
                $d->iquery("entities", ['title' => $title, 'u_id' => $u_id, 'des' => $des,'parent'=>$parent]);
                $value = $d->insert_id();
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $value . '</td>
                        <td>' . $title . '</td>
                        <td>' . $des . '</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="entities" data-id="' . $value . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res = [
                    'status'=>false,
                    'message'=>'<div class="alert alert-danger" role="alert">Title is required.</div>'
                ];
            }
        }
        break;
    case 'get_entity_child':
        $parent = test_input($_REQUEST['parent']);
        if(!empty($parent) and is_numeric($parent)){
            $table = '';
            $q = $d->query("select * from entities where parent={$parent}");
            while($row = $d->fetch($q)){
                $table .= '
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td contenteditable="true">' . $row['title'] . '</td>
                        <td contenteditable="true">' . $row['des'] . '</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="entities" data-id="' . $row['id'] . '">Delete</button>
                            <button class="btn btn-sm btn-warning edit-rows" data-type="entities" data-id="' . $row['id'] . '">Edit</button>
                        </td>
                    </tr>
                ';
            }
            $res = [
                'status'=>true,
                'html'=>$table
            ];
        }else{
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Incorrect Entity.</div>'
            ];
        }
        break;
    case 'add_phrases':
        if($ug_id > 2){
            $res['status'] = false;
            $res['message'] = '<div class="alert alert-danger" role="alert">Permission Require</div>';
        }else {
            $text = test_input($_REQUEST['text']);
            $text = text_normalizer($text);
            $time = test_input($_REQUEST['time']);
            $link = test_input($_REQUEST['link']);
            $project = test_input($_REQUEST['project']);
            if (!empty($text) and !empty($project) and is_numeric($project)) {
                $d->iquery("project_phrases", ['text' => $text, 'time' => $time, 'link' => $link,'project'=>$project]);
                $id = $d->insert_id();
                $words = explode(" ", $text);
                foreach ($words as $word) {
                    if ($word!="") {
                        $d->iquery("project_phrases_words", ['phrases' => $id, 'word' => $word]);
                    }
                }
                $res = [
                    'html' => '
                    <tr>
                        <td>' . $id . '</td>
                        <td>' . $text . '</td>
                        <td>' . $time . '</td>
                        <td>
                            <a href="index.php?action=tag&id=' . $id . '" class="btn btn-sm btn-primary">Annotation</a>
                            <button class="btn btn-sm btn-danger delete-rows" data-type="project_phrases" data-id="' . $id . '">Delete</button>
                        </td>
                    </tr>
                  ',
                    'status' => true
                ];
            } else {
                $res['status'] = false;
                $res['message'] = '<div class="alert alert-danger" role="alert">Text input is required.</div>';
            }
        }
        break;
    case 'importExcel':
        if($ug_id > 2){
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Permission Require</div>'
            ];
        }else {
            if (0 < $_FILES['file']['error']) {
                $res = [
                    'status'=>false,
                    'message'=>'<div class="alert alert-danger" role="alert">' . $_FILES['file']['error'] . "</div>"
                ];
            } else {
                $allowed = array('xlsx', 'xls');
                $filename = $_FILES['file']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    $res = [
                        'status'=>false,
                        'message'=> '<div class="alert alert-danger" role="alert">Please upload xlsx or xls files</div>'
                    ];
                } else {
//                    $inputFileName = '/var/www/annotate.adcore.ir/uploads/' . $u_id . "_" . time() . '.' . $ext;
//                    move_uploaded_file($_FILES['file']['tmp_name'], $inputFileName);
                    $inputFileName = $_FILES['file']['tmp_name'];
                    require_once 'include/excel/PHPExcel/IOFactory.php';
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        $try = true;
                    } catch (Exception $e) {
                        $try = false;
                        unlink($inputFileName);
                    }
                    if ($try) {
                        $html_res = "";
                        $sheet = $objPHPExcel->getSheet(0);
                        $highestRow = $sheet->getHighestRow();
                        $highestColumn = $sheet->getHighestColumn();
                        $max_id = $d->fetch($d->query('select max(id) as m from project_phrases;'))['m'];
                        $array_of_texts = [];
                        $array_of_project_words = [];
                        $max_id = (int)$max_id;
                        $highestRow = (int) $highestRow; 
                        for ($row = 2; $row <= $highestRow; $row++) {
                            
                            $max_id+=1;
                            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                NULL,
                                TRUE,
                                FALSE);
                            $text = test_input($rowData[0][0]);
                            $text = text_normalizer($text);
                            $time = test_input($rowData[0][1]);
                            $link = test_input($rowData[0][2]);
                            $project = test_input($_REQUEST['project']);
                            array_push($array_of_texts, ['text' => $text, 'time' => $time, 'link' => $link,'project'=>$project, 'id'=>$max_id]);
                            $words = explode(" ", $text);
                            foreach ($words as $word) {
                                if($word != "")
                                    array_push($array_of_project_words, ['phrases' => $max_id, 'word' => $word]);
                            }
                            $id = $max_id;
                            $html_res .= '
                            <tr>
                                <td>' . $id . '</td>
                                <td>' . $text . '</td>
                                <td>' . $time . '</td>
                                <td>
                                    <a href="index.php?action=tag&id=' . $id . '" class="btn btn-sm btn-primary">Annotation</a>
                                    <button class="btn btn-sm btn-danger delete-rows" data-type="project_phrases" data-id="' . $id . '">Delete</button>
                                </td>
                            </tr>
                          ';
                        }
                        $sql = array(); 
                        foreach( $array_of_texts as $arr_data ) {
                            $sql[] = '("'.$arr_data['text'].'", "'.$arr_data['time'].'", "'.$arr_data['link'].'", '.
                            $arr_data['id'].', '. $arr_data['project'].')';
                        }
                        $values = implode(',', $sql);
                        $query = 'insert into project_phrases (text, time, link, id, project) values '.$values;
                        $d->query($query);
                        
                        $sql = array(); 
                        foreach( $array_of_project_words as $arr_data ) {
                            $sql[] = '('.$arr_data['phrases'].', "'.$arr_data['word'].'")';
                        }
                        $values = implode(',', $sql);
                        $query = 'insert into project_phrases_words (phrases, word) values '.$values;
                        $d->query($query);
                        
                        unlink($inputFileName);
                        $res = [
                            'html' => $html_res,
                            'status' => true
                        ];
                    } else {
                        $res = [
                            'message' => '<div class="alert alert-danger" role="alert">\'Error loading file "\'.pathinfo($inputFileName,PATHINFO_BASENAME).\'": \'.$e->getMessage()</div>',
                            'status' => false
                        ];
                    }
                }
            }
        }
        break;
    case 'set_event':
        $event = test_input($_REQUEST['value']);
        $phrase_id = test_input($_REQUEST['phrase']);
        if($ug_id >2){
            $event_name = $d->getrowvalue("title", "select title from events where id='" . $event . "' and u_id=" . $parent_id, true);
        }else {
            $event_name = $d->getrowvalue("title", "select title from events where id='" . $event . "' and u_id=" . $u_id, true);
        }
        if(!empty($event_name)) {
            $words = test_input($_REQUEST['words']);
            $words = explode(",",$words);
            $i = 0;
            foreach($words as $word){
                $q = $d->query("delete from project_phrases_words_events where u_id={$u_id} and word={$word}");
                if ($i == 0) $type = "B_";
                else $type = "I_";
                if($i == 0) {
                    $d->iquery('project_phrases_words_events', ['u_id'=>$u_id, 'word' => $word, 'events' => $event, 'type' => $type]);
                    $id = $d->insert_id();
                }
                else
                    $d->iquery('project_phrases_words_events', ['u_id'=>$u_id,'word' => $word, 'events' => $event, 'type' => $type,'parent'=>$id]);
                $i++;
            }
            $res = [
                'status' => true
            ];
        }else{
            $res = [
                'message' => '<div class="alert alert-danger" role="alert">Incorrect Event.</div>',
                'status' => false
            ];
        }
        break;
    case 'set_entity':
        $entity = test_input($_REQUEST['value']);
        $project_id = test_input($_REQUEST['project']);
        if($ug_id >2){
            $entity_name = $d->getrowvalue("title", "select title from entities where id='" . $entity . "' and u_id=" . $parent_id, true);
        }else {
            $entity_name = $d->getrowvalue("title", "select title from entities where id='" . $entity . "' and u_id=" . $u_id, true);
        }
        if(!empty($entity_name)) {
            $words = test_input($_REQUEST['words']);
            $words = explode(",",$words);
            $i = 0;
            foreach($words as $word){
                $q = $d->query("delete from project_phrases_words_entities where u_id={$u_id} and word={$word}");
                if ($i == 0) $type = "B_";
                else $type = "I_";
                if($i == 0) {
                    $d->iquery('project_phrases_words_entities', ['u_id'=>$u_id,'word' => $word, 'entity' => $entity, 'type' => $type]);
                    $id = $d->insert_id();
                }
                else
                    $d->iquery('project_phrases_words_entities', ['u_id'=>$u_id,'word' => $word, 'entity' => $entity, 'type' => $type,'parent'=>$id]);
                $i++;
            }
            $res = [
                'status' => true
            ];
        }else{
            $res = [
                'message' => '<div class="alert alert-danger" role="alert">Incorrect Entity.</div>',
                'status' => false
            ];
        }
        break;
    case 'get_entity':
        $words = explode(",",test_input($_REQUEST['words']));
        $word = $words[0];
        $entity_word_title = $d->getrowvalue("title","select group_concat(word separator ' ') as title from project_phrases_words where id in (".$_REQUEST['words'].")",true);
        $entity = $d->getrowvalue("entity","select entity from project_phrases_words_entities where u_id={$u_id} and word=".$word,true);
        $word_entity_id = $d->getrowvalue("id","select id from project_phrases_words_entities where u_id={$u_id} and word=".$word,true);
        $entity_ins = $d->fetch($d->query("select * from entities where id=".$entity));
        $entity_title = $entity_ins['title'];
        $argument_option = [];
        $phrases = $d->getrowvalue("phrases","select phrases from project_phrases_words where id=".$word,true);
        $entities = '<table class="table table-striped">';
        $q = $d->query("select project_phrases_words.id,project_phrases_words.word from 
                                project_phrases_words,
                                project_phrases,
                                project_users 
                              where 
                                project_phrases_words.phrases = project_phrases.id and
                                project_phrases.project = project_users.project and 
                                project_phrases.id = {$phrases} and 
                                project_users.u_id=".$u_id." 
                              order by project_phrases_words.id asc");
        while($row = $d->fetch($q)){
            $hasEvent = $d->getrowvalue("type","select `type` from project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.events = events.id and word=".$row['id'],true);
            if($hasEvent == "B_"){
                $word_id = $d->getrowvalue("id","select `id` from project_phrases_words_events where u_id={$u_id} and word=".$row['id'],true);
                $inline_text = $d->getrowvalue("text","select GROUP_CONCAT(DISTINCT project_phrases_words.word SEPARATOR ' ') as text from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and (project_phrases_words_events.word=".$row['id']." or project_phrases_words_events.parent=".$word_id.")",true);
                $inline_id = $d->getrowvalue("text","select GROUP_CONCAT(DISTINCT project_phrases_words.id SEPARATOR ',') as text from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and (project_phrases_words_events.word=".$row['id']." or project_phrases_words_events.parent=".$word_id.")",true);
                $word_event_id = $d->getrowvalue("events","select events from project_phrases_words_events where u_id={$u_id} and word=".$row['id'],true);
                $this_event_id = $d->getrowvalue("id","select id from project_phrases_words_events where u_id={$u_id} and word=".$row['id'],true);
                $entities .= '
                        <tr>
                            <td>'.$inline_text.'</td>
                            <td>
                                <select class="form-control set_argument" data-event="'.$this_event_id.'" data-words="'.$_REQUEST['words'].'">
                                    <option value="0"></option>';
                $qq = $d->query("select id,title,des from arguments where event_id=".$word_event_id);
                while($res = $d->fetch($qq)){
//                    $hasArgument = $d->getrowvalue("id","select id from project_phrases_words_arguments where u_id={$u_id} and argument={$res['id']} and event={$word_event_id} and word in (".$_REQUEST['words'].")",true);
                    $hasArgument = $d->getrowvalue("id","select id from project_phrases_words_arguments where u_id={$u_id} and argument={$res['id']} and event={$this_event_id} and word in (".$_REQUEST['words'].")",true);
                    if(!empty($res[$using_key_lang])) $res[$using_key_lang] = $res[$using_key_lang];
                    if(empty($hasArgument)){
                        $entities .= '<option value="'.$res['id'].'">'.$res[$using_key_lang].'</option>';
                    }else{
                        $entities .= '<option value="'.$res['id'].'" selected>'.$res[$using_key_lang].'</option>';
                    }
                }
                $entities .= '</select>
                            </td>
                        </tr>';
            }
        }
        $html = '
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-danger btn-sm btn-delete delete-box" data-type="project_phrases_words_entities" data-id="'.$word_entity_id.'">'.$DELETE_THIS_ENTITY[$using_lang].'</button>
            </div>
        </div>
        <hr>
        <h3>'.$entity_word_title.' : '.$entity_ins[$using_key_lang].'</h3>
        <hr>
        '.$entities;
        $res = [
            'status'=>true,
            'html'=>$html
        ];
        break;
    case 'get_event':
        $words = explode(",",test_input($_REQUEST['words']));
        $word = $words[0];
        $event_word_title = $d->getrowvalue("title","select group_concat(word separator ' ') as title from project_phrases_words where id in (".$_REQUEST['words'].")",true);
//        $exp = explode(' ', $event_word_title);
//        $array = array_reverse($exp);
//        $newStr = implode(" ",$array);
//        echo $event_word_title . "\n";
//        echo $newStr . "\n";
        $event = $d->getrowvalue("events","select events from project_phrases_words_events where u_id={$u_id} and word=".$word,true);
        $word_event_id = $d->getrowvalue("id","select id from project_phrases_words_events where u_id={$u_id} and word=".$word,true);
        $evetIns = $d->fetch($d->query("select * from events where id=".$event));
        $event_title = $eventIns['title'];
        $q = $d->query("select * from project_phrases_words_events where u_id={$u_id} and word=".$word);
        $event_info = $d->fetch($q);
        $argument_option = [];
        $q = $d->query("select * from arguments where event_id = ".$event);
        while($row = $d->fetch($q)){
            $argument_option[$row['id']]['title'] = $row['title'];
            $argument_option[$row['id']]['des'] = $row['des'];
        }
        $phrases = $d->getrowvalue("phrases","select phrases from project_phrases_words where id=".$word,true);
        $entities = '<table class="table table-striped">';
        $q = $d->query("select project_phrases_words.id,project_phrases_words.word from 
                                project_phrases_words,
                                project_phrases,
                                project_users 
                              where 
                                project_phrases_words.phrases = project_phrases.id and
                                project_phrases.project = project_users.project and 
                                project_phrases.id = {$phrases} and 
                                project_users.u_id=".$u_id." 
                              order by project_phrases_words.id asc");
        while($row = $d->fetch($q)){
            $hasEntity = $d->getrowvalue("type","select `type` from project_phrases_words_entities where u_id={$u_id} and word=".$row['id'],true);
            if($hasEntity == "B_"){
                $word_id = $d->getrowvalue("id","select `id` from project_phrases_words_entities where u_id={$u_id} and word=".$row['id'],true);
                $inline_text = $d->getrowvalue("text","select GROUP_CONCAT(project_phrases_words.word SEPARATOR ' ') as text from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=".$row['id']." or project_phrases_words_entities.parent=".$word_id.")",true);
                $inline_id = $d->getrowvalue("text","select GROUP_CONCAT(project_phrases_words.id SEPARATOR ',') as text from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=".$row['id']." or project_phrases_words_entities.parent=".$word_id.")",true);
                $entities .= '
                        <tr>
                            <td>'.$inline_text.'</td>
                            <td>
                                <select class="form-control set_argument" data-event="'.$word_event_id.'" data-words="'.$inline_id.'">
                                    <option value="0"></option>';
                foreach($argument_option as $arg_id=>$arg_value){
//                    $hasArgument = $d->getrowvalue("id","select id from project_phrases_words_arguments where u_id={$u_id} and argument={$arg_id} and event={$event} and word in (".$inline_id.")",true);
                    $hasArgument = $d->getrowvalue("id","select id from project_phrases_words_arguments where u_id={$u_id} and argument={$arg_id} and event={$word_event_id} and word in (".$inline_id.")",true);
                    if(!empty($arg_value[$using_key_lang])) $arg_value[$using_key_lang] = $arg_value[$using_key_lang];
                    if(empty($hasArgument)){
                        $entities .= '<option value="'.$arg_id.'">'.$arg_value[$using_key_lang].'</option>';
                    }else{
                        $entities .= '<option value="'.$arg_id.'" selected>'.$arg_value[$using_key_lang].'</option>';
                    }
                }
                $entities .= '</select>
                            </td>
                        </tr>';
            }
        }
        $entities .= '</table>';
        
        $selected_tens = array('Unspecified' => '', 'Past' => '', 'Now'=>'', 'Future'=>'', '0'=>'');
        $selected_tens[$event_info['tens']] = 'selected';
        $tens_option = 
            "<option value='0' {$selected_tens['0']}></option>
            <option value='Unspecified' {$selected_tens['Unspecified']}>$UNSPECIFIED[$using_lang]</option>
            <option value='Past' {$selected_tens['Past']}>$PAST[$using_lang]</option>
            <option value='Now' {$selected_tens['Now']}>$NOW[$using_lang]</option>
            <option value='Future' {$selected_tens['Future']}>$FUTURE[$using_lang]</option>";
        
        $selected_asserted = array('Asserted' => '', 'Other'=>'', '0'=>'');
        $selected_asserted[$event_info['asserted']] = 'selected';
        $asserted_option = 
            "<option value='0' {$selected_asserted['Default']}></option>
            <option value='Asserted' {$selected_asserted['Asserted']}>{$ASSERTED[$using_lang]}</option>
            <option title={$LIST_OF_UNCERTIANS[$using_lang]} value='Other' {$selected_asserted['Other']}>{$OTHER[$using_lang]}</option>";
        
        $selected_polarity = array('Positive' => '', 'Negative'=>'', '0'=>'');
        $selected_polarity[$event_info['polarity']] = 'selected';
        $polarity_option = 
            "<option value='0' {$selected_polarity['0']}></option>
            <option value='Positive' {$selected_polarity['Positive']}>{$POSITIVE[$using_lang]}</option>
            <option title={$LIST_OF_NEGATIVES[$using_lang]} value='Negative' {$selected_polarity['Negative']}>{$NEGATIVE[$using_lang]}</option>";
        
        
        $html = '
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-danger btn-sm btn-delete delete-box" data-type="project_phrases_words_events" data-id="'.$word_event_id.'">'.$DELETE_THIS_EVENT[$using_lang].'</button>
            </div>
        </div>
        <hr>
        <h3>'.$event_word_title.' : '.$evetIns[$using_key_lang].'</h3>
        <table class="table">
            <tr><td>'.$TENS[$using_lang].'</td><td><select class="form-control set_tens" data-event="'.$word_event_id.'">'.$tens_option.'</select></td>
            <td>'.$MODALITY[$using_lang].'</td><td><select class="form-control set_asserted" data-event="'.$word_event_id.'">'.$asserted_option.'</select></td></tr>
            <td>'.$POLARITY[$using_lang].'</td><td><select class="form-control set_polarity" data-event="'.$word_event_id.'">'.$polarity_option.'</select></td></tr>
        </table>
        <hr>
        '.$entities;
        $res = [
            'status'=>true,
            'html'=>$html
        ];
        break;
    case 'set_tens':
        $event = test_input($_REQUEST['event']);
        $tens = test_input($_REQUEST['tens']);
        if($tens === 0) $tens = NULL;
        $d->uquery("project_phrases_words_events",['tens'=>$tens],'id='.$event);
        $res['status'] = true;
        break;
    case 'set_asserted':
        $event = test_input($_REQUEST['event']);
        $asserted = test_input($_REQUEST['asserted']);
        if($asserted === 0) $asserted = NULL;
        $d->uquery("project_phrases_words_events",['asserted'=>$asserted],'id='.$event);
        $res['status'] = true;
        break;
    case 'set_polarity':
        $event = test_input($_REQUEST['event']);
        $polarity = test_input($_REQUEST['polarity']);
        if($polarity === 0) $polarity = NULL;
        $d->uquery("project_phrases_words_events",['polarity'=>$polarity],'id='.$event);
        $res['status'] = true;
        break;
    case 'set_argument':
        $argument = test_input($_REQUEST['argument']);
        $event = test_input($_REQUEST['event']);
        echo $event."\n";
        echo $parent_id."\n";
        if($ug_id >2){
//            $event_name = $d->getrowvalue("title", "select title from events where id='" . $event . "' and u_id=" . $parent_id, true);
            $event_name = $d->getrowvalue("events", "select events from project_phrases_words_events where id='" . $event . "' and u_id=" . $u_id, true);
        }else {
//            $event_name = $d->getrowvalue("title", "select title from events where id='" . $event . "' and u_id=" . $u_id, true);
            $event_name = $d->getrowvalue("events", "select events from project_phrases_words_events where id='" . $event . "' and u_id=" . $u_id, true);
        }
        echo $event_name."\n";
        if(!empty($event_name)) {
            $words = test_input($_REQUEST['words']);
            $words = explode(",",$words);
            $i = 0;
            foreach($words as $word){
                $entity = $d->getrowvalue("id","select id from project_phrases_words_entities where u_id={$u_id} and word=".$word,true);
                $d->query("delete from project_phrases_words_arguments where u_id={$u_id} and event={$event} and word=".$word);
                if ($i == 0) $type = "B_";
                else $type = "I_";
                if($i == 0) {
                    $d->iquery('project_phrases_words_arguments', ['u_id'=>$u_id,'word' => $word, 'event' => $event,'entity'=>$entity,'argument'=>$argument, 'type' => $type]);
                    $id = $d->insert_id();
                }
                else
                    $d->iquery('project_phrases_words_arguments', ['u_id'=>$u_id,'word' => $word, 'event' => $event,'entity'=>$entity,'argument'=>$argument, 'type' => $type,'parent'=>$id]);
                $i++;
            }
            $res = [
                'status' => true
            ];
        }elseif($argument == 0){
            $words = test_input($_REQUEST['words']);
            $words = explode(",",$words);
            foreach($words as $word) {
                $d->query("delete from project_phrases_words_arguments where u_id={$u_id} and event={$event} and word=".$word);
            }
            $res = [
                'status' => true
            ];
        }else{
            $res = [
                'status'=>false,
                'message'=>'<div class="alert alert-danger" role="alert">Incorrect Event.</div>'
            ];
        }
        break;
    case 'delete_rows':
        $id = test_input($_REQUEST['id']);
        $table = test_input($_REQUEST['type']);

        if($table == "projects" or $table == "entities" or $table == "events" or $table == "arguments" or $table == 'project_phrases' or $table == "project_phrases_words_entities" or $table == "project_phrases_words_events" or $table == "user") {
            if (!empty($id)) {
                $d->query("delete from ".$table." where id = '" . $id."'");
                $res['status'] = true;
            } else {
                $res['status'] = false;
            }
        }else{
            $res['status'] = false;
        }
        break;
    case 'edit_row':
        $id = test_input($_REQUEST['id']);
        $table = test_input($_REQUEST['type']);
        $title = test_input($_REQUEST['title']);
        $alias = test_input($_REQUEST['alias']);
        if(!empty($table)) {
            if (!empty($id)) {
                $d->query("update ".$table." set title='". $title. "', des='".$alias. "' where id= '" . $id."'");
                $res['status'] = true;
            } else {
                $res['status'] = false;
            }
        }else{
            $res['status'] = false;
        }
        break;
    case 'change_lang':
        $lang = test_input($_REQUEST['lang']);
        $_SESSION['using_lang'] = $lang;
        $res=array('lang'=>$lang, 'status' => true);
        break;
    default:
        $res = ['status'=>false];
}

echo json_encode($res);