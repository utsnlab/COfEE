<?php
$project_table = "";
$using_lang = $_SESSION['using_lang'];
$cnt = $d->getrowvalue("cnt","select count(*) as cnt from projects,project_users where project_users.project = projects.id and project_users.u_id={$u_id}",true);
if($start >= $cnt) {
    $start = 0;
    $current_page = 1;
}
$q = $d->query("select * from projects,project_users where project_users.project = projects.id and project_users.u_id={$u_id} limit {$start},{$limit_per_page}");
while($row = $d->fetch($q)){
    if($ug_id < 3){
        $add_user_button = '<button class="btn btn-sm btn-info" data-toggle="modal" data-project="'.$row['id'].'" data-target="#setUser">'.$ADD_USER[$using_lang].'</button>';
        $delete_button = '<button class="btn btn-sm btn-danger delete-rows" data-type="projects" data-id="'.$row['id'].'">'.$DELETE[$using_lang].'</button>';
        $export_button = '<a target="_blank" href="export.php?id='.$row['id'].'" class="btn btn-sm btn-primary">'.$EXPORT[$using_lang].'</a>';
    }
    $next = $d->getrowvalue("id","select id from project_phrases where id not in (select phrases from project_phrases_status where u_id = {$u_id}) and project_phrases.project=".$row['id']." order by id asc limit 0 , 1",true);
    $users = $d->getrowvalue("users","select GROUP_CONCAT(user.username) as users from user,project_users where user.id = project_users.u_id and project = ".$row['id'],true);
    $users = str_replace(',', ', ', $users);
    $project_table .= '
            <tr>
                <td>'.$row['id'].'</td>
                <td><a href="index.php?action=tag&id='.$next.'">'.$row['title'].'</a></td>';

    if($ug_id < 3)
        $project_table .='<td>'.$row['user_num'].'</td>
            <td>'.$row['annotation_num'].'</td>
            <td id="project'.$row['id'].'">'.$users.'</td>';
    
    $project_table .='<td>
                    '.$add_user_button.'
                    <a href="index.php?action=phrases&id='.$row['id'].'" class="btn btn-sm btn-success">'.$ANNOTATE[$using_lang].'</a>
                    '.$export_button.'
                    '.$delete_button.'
                </td>
            </tr>';
}
if($ug_id < 3){
    $add_project_section = '
    <section>
    <div class="error-box"></div>
    <form id="addProject">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="des">Description</label>
            <textarea class="form-control" id="des" name="des" rows="3"></textarea>
        </div>
        <div class="form-group" hidden>
            <label for="user_num">Number of add user for projects</label>
            <input class="form-control" type="number" id="user_num" name="user_num" value="1000">
        </div>
        <div class="form-group">
            <label for="annotation_num">Number of annotation per record</label>
            <input class="form-control" type="number" id="annotation_num" name="annotation_num" value="1">
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="rtl" class="custom-control-input" id="customCheck1" value="1">
            <label class="custom-control-label" for="customCheck1">RTL Version</label>
        </div>
        <hr>
    </form>
    <button type="submit" class="btn btn-primary add-project">Submit</button>
</section>
    ';
}
$paginate = paginate($cnt,$limit_per_page,$current_page,'index.php?action=project&page=');
$user_option = '';
$q = $d->query("select id,username from user where parent=".$u_id);
while($row = $d->fetch($q)){
    $user_option .= '<option value="'.$row['id'].'">'.$row['username'].'</option>';
}
$content = file_get_contents($action.".html");
if($ug_id>2){
    $content = str_replace('<th>Number of Annotates</th>', '', $content);
    $content = str_replace('<th>Number of users</th>', '', $content);
    $content = str_replace('<th>Users</th>', '', $content);
}
$content = str_replace(['[-projects-]','[-users-]','[-add_project_section-]','[-paginate-]'],[$project_table,$user_option,$add_project_section,$paginate],$content);