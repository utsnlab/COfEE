<?php
$project = $_GET['id'];
if(is_numeric($project)) {
    $phrases_table = "";
    $next = $d->getrowvalue("id","select id from project_phrases where project = {$project} and id in(select phrases from project_phrases_status where status=3 and u_id={$u_id}) order by id asc limit 0 , 1",true);
    
    if(empty($next)) {
        $next = $d->getrowvalue("id","select id from project_phrases where project = {$project} and num_of_visit > 0 and id not in (select phrases from project_phrases_status where u_id = {$u_id}) order by id asc limit 0 , 1",true);
    }
    if(!empty($next)) {
        $start_annotation = '<a href="index.php?action=tag&id='.$next.'" class="btn btn-success btn-delete center-block">'.$START_ANNOTATION[$using_lang].'</a>';
        $d->query("update project_phrases set num_of_visit = num_of_visit-1 where id = {$next}");
        $d->query("delete from project_phrases_status where u_id={$u_id} and phrases={$next}");
        $d->iquery("project_phrases_status", ['u_id' => $u_id, 'phrases' => $next, 'status' => 3]);
    }
    
    if($ug_id <3) {
        $cnt = $d->getrowvalue('cnt',"select count(*) as cnt from project_phrases,project_users where project_users.project = project_phrases.project and project_users.u_id={$u_id} and project_phrases.project = {$project}",true);
        if($start >= $cnt) {
            $start = 0;
            $current_page = 1;
        }
        
        $q = $d->query("select * from project_phrases,project_users where project_users.project = project_phrases.project and project_users.u_id={$u_id} and project_phrases.project = {$project} limit {$start},{$limit_per_page}");
        while ($row = $d->fetch($q)) {
            $status = "";
            $qq = $d->query("select u_id,username from project_users,user where project_users.u_id = user.id and project=".$row['project']);
            while($res = $d->fetch($qq)){
                $statusCheck = $d->getrowvalue("status","select status from project_phrases_status where u_id=".$res['u_id']." and phrases=".$row['id'],true);
                if(empty($statusCheck)){
                    $status .= '<span class="btn btn-info btn-sm btn-show-status">'.$res['username'].' : -</span><br>';
                }elseif($statusCheck == 1){
                    $status .= '<span class="btn btn-success btn-sm btn-show-status">'.$res['username'].' : Confirmed</span><br>';
                }elseif($statusCheck == 2){
                    $status .= '<span class="btn btn-danger btn-sm btn-show-status">'.$res['username'].' : Canceled</span><br>';
                }
                elseif($statusCheck == 3){
                    $status .= '<span class="btn btn-secondary btn-sm btn-show-status">'.$res['username'].' : In process</span><br>';
                }
            }
            $status = rtrim($status,"<br>");
            $phrases_table .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['text'] . '</td>
                <td>'.$status.'</td>
                <td>
                    <a href="index.php?action=tag&id=' . $row['id'] . '" class="btn btn-sm btn-primary">Annotation</a>
                    <button class="btn btn-sm btn-danger delete-rows" data-type="project_phrases" data-id="' . $row['id'] . '">Delete</button>
                </td>
            </tr>';
        }
        $add_phrases_section = '
            <section>
                <button class="btn btn-success" data-toggle="modal" data-target="#importExcel">Import From Excel</button>
                <hr>
                <div class="error-box"></div>
                <form id="addPhrases">
                    <input type="text" name="project" hidden value="' . $project . '">
                    <div class="form-group" hidden>
                        <label for="link">Link</label>
                        <input class="form-control" id="link" name="link">
                    </div>
                    <div class="form-group" hidden>
                        <label for="time">Time</label>
                        <input class="form-control" id="time" name="time">
                    </div>
                    <div class="form-group">
                        <label for="inputText">Please enter input text.</label>
                        <textarea class="form-control" id="inputText" name="text" rows="3" required></textarea>
                    </div>
                </form>
                <button type="submit" class="btn btn-primary add-phrases">Submit</button>
            </section>
    ';
    }
    else{
        $cnt = $d->getrowvalue('cnt',"select count(*) as cnt from project_phrases,project_phrases_status where project_phrases.id = project_phrases_status.phrases and project_phrases_status.u_id={$u_id}",true);
        
        if($start >= $cnt) {
            $start = 0;
            $current_page = 1;
        }

        $q = $d->query("select * from project_phrases,project_phrases_status where project_phrases_status.phrases = project_phrases.id and project_phrases_status.u_id={$u_id} and project_phrases.project = {$project} limit {$start},{$limit_per_page}");
        
        $annotation_num = $d->getrowvalue('annotation_num',"select annotation_num from projects where id={$project}",true);
        while($row = $d->fetch($q)){
                if($row['status'] == 1){
                    $status = '<span class="btn btn-success btn-sm btn-show-status">Confirmed</span><br>';
                }elseif($row['status']==2){
                    $status = '<span class="btn btn-danger btn-sm btn-show-status">Canceled</span><br>';
                }
                elseif($row['status']==3){
                    $status = '<span class="btn btn-secondary btn-sm btn-show-status">Pending</span><br>';
                }

                $phrases_table .= '
                <tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['text'] . '</td>
                    <td>' . $status . ' </td>
                    <td>
                        <a href="index.php?action=tag&id=' . $row['id'] . '" class="btn btn-sm btn-primary">Annotation</a>
                    </td>
                </tr>';
        }
    }
    $paginate = paginate($cnt,$limit_per_page,$current_page,'index.php?action=phrases&id=' . $project . '&page=');
    $content = file_get_contents($action . ".html");
    $content = str_replace(['[-phrases-]','[-add_phrases_section-]','[-project_id-]','[-start_annotation-]','[-paginate-]'], [$phrases_table, $add_phrases_section,$project,$start_annotation,$paginate], $content);
}else{
    $content = "";
}