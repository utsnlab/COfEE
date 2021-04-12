<?php
$all_projects = $d->getrowvalue("cnt","select count(*) as cnt from project_users where u_id={$u_id}",true);
$confirmed_annotate = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases_status where status =1 and u_id={$u_id}",true);
$canceled_annotate = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases_status where  status =2 and u_id={$u_id}",true);
$all_project_id = $d->getrowvalue("cnt","select group_concat(project separator ',') as cnt from project_users where u_id={$u_id}",true);
if(!empty($all_project_id))
    $all_phrases = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases where project in({$all_project_id})",true);
else $all_phrases = 0;
$content = file_get_contents($action . ".html");
$content = str_replace(['[-all_projects-]','[-confirmed_annotate-]','[-canceled_annotate-]','[-all_phrases-]'], [$all_projects,$confirmed_annotate,$canceled_annotate,$all_phrases], $content);
$q = $d->query("select * from user where parent={$u_id}");
$sub_users_rows = '';
while ($row = $d->fetch($q)) {
    $username = $row['username'];
    $user_id = $row['id'];
    $confirmed_annotate = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases_status where status =1 and u_id={$user_id}",true);
    $canceled_annotate = $d->getrowvalue("cnt","select count(*) as cnt from project_phrases_status where  status =2 and u_id={$user_id}",true);
    $sub_users_rows .= "
        <tr>
            <td>{$user_id}</td>
            <td>{$username}</td>
            <td>{$confirmed_annotate}</td>
            <td>{$canceled_annotate}</td>
        </tr>";
}
if($sub_users_rows!='') {
    $content = str_replace(['hidden'], [''], $content);
    $content = str_replace(['[-sub_users_rows-]'], [$sub_users_rows], $content);    
}
else {
    $content = str_replace(['[-sub_users_rows-]'], [''], $content);    
}