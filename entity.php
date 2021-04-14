<?php
$using_lang = $_SESSION['using_lang'];
if($ug_id > 2){
    $content = '<div class="alert alert-danger" role="alert">Permission Require</div>';
}else {
    $entity_table = "";
    $cnt = $d->getrowvalue("cnt","select count(*) as cnt from entities where u_id={$u_id} and parent is null",true);
    if($start >= $cnt) {
        $start = 0;
        $current_page = 1;
    }
    $q = $d->query("select * from entities where u_id={$u_id} and parent is null limit {$start},{$limit_per_page}");
    while ($row = $d->fetch($q)) {
        if($using_lang == 'fa') {
            $desc_row = $row['des'];
        }
        else {
            $desc_row = $row['title'];
        }
        $entity_table .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['title'] . '</td>
                <td>' . $desc_row . '</td>
                <td>
                    <button class="btn btn-sm btn-info" data-toggle="modal" data-entity="'.$row['id'].'" data-target="#addEntityChildModal">Childes</button>
                    <button class="btn btn-sm btn-danger delete-rows" data-type="entities" data-id="' . $row['id'] . '">Delete</button>
                </td>
            </tr>';
    }
    $paginate = paginate($cnt,$limit_per_page,$current_page,'index.php?action=entity&page=');
    $content = file_get_contents($action . ".html");
    $content = str_replace(['[-entity_table-]','[-paginate-]'], [$entity_table,$paginate], $content);
}