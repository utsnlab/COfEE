<?php
if($ug_id > 2){
    $content = '<div class="alert alert-danger" role="alert">Permission Require</div>';
}else {
    $events_table = "";
    $cnt = $d->getrowvalue("cnt","select count(*) as cnt from events where parent is null and u_id={$u_id}",true);
    if($start >= $cnt) {
        $start = 0;
        $current_page = 1;
    }
    $q = $d->query("select * from events where parent is null and u_id={$u_id} limit {$start},{$limit_per_page}");
    while ($row = $d->fetch($q)) {
        $events_table .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['title'] . '</td>
                <td>' . $row['des'] . '</td>
                <td>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#eventChildren" data-parent="' . $row['id'] . '">Children</button>
                    <button class="btn btn-sm btn-danger delete-rows" data-type="events" data-id="' . $row['id'] . '">Delete</button>
                </td>
            </tr>';
    }
    $paginate = paginate($cnt,$limit_per_page,$current_page,'index.php?action=event&page=');
    $content = file_get_contents($action . ".html");
    $content = str_replace(['[-events-]','[-paginate-]'], [$events_table,$paginate], $content);
}