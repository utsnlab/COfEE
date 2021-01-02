<?php
if($ug_id > 2){
    $content = '<div class="alert alert-danger" role="alert">Permission Requier</div>';
}else {
    $users_table = "";
    $cnt = $d->getrowvalue("cnt","select count(*) as cnt from user where parent= {$u_id}",true);
    if($start >= $cnt) {
        $start = 0;
        $current_page = 1;
    }
    $q = $d->query("select id,username from user where parent= {$u_id} limit {$start},{$limit_per_page}");
    while ($row = $d->fetch($q)) {
        $users_table .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['username'] . '</td>
                <td>
                    <button class="btn btn-sm btn-info user-statistics" data-toggle="modal" data-target="#userStatistics" data-id="' . $row['id'] . '">Statistics</button>
                    <button class="btn btn-sm btn-danger delete-rows" data-id="' . $row['id'] . '">Delete</button>
                </td>
            </tr>';
    }
    $paginate = paginate($cnt,$limit_per_page,$current_page,'index.php?action=users&page=');
    $content = file_get_contents($action . ".html");
    $content = str_replace(['[-users-]','[-paginate-]'], [$users_table,$paginate], $content);
}