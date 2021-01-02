<?php
$status = true;
if(isset($_GET['confirmed'])){
    if(is_numeric($_GET['confirmed'])){
        $confirmed = test_input($_GET['confirmed']);
        $d->query("delete from project_phrases_status where u_id={$u_id} and phrases={$confirmed}");
        $d->iquery("project_phrases_status",['u_id'=>$u_id,'phrases'=>$confirmed,'status'=>1]);
    }else{
        $status = false;
    }
}
if(isset($_GET['cancel'])){
    if(is_numeric($_GET['cancel'])){
        $cancel = test_input($_GET['cancel']);
        $d->query("delete from project_phrases_status where u_id={$u_id} and phrases={$cancel}");
        $d->iquery("project_phrases_status",['u_id'=>$u_id,'phrases'=>$cancel,'status'=>2]);
    }else{
        $status = false;
    }
}
if($status) {
    $id = test_input($_GET['id']);
    if(!empty($id)) {
        $_SESSION['user']['rtl'] = $d->getrowvalue("rtl","select rtl from project_phrases,projects where project_phrases.project = projects.id and project_phrases.id={$id}",true);
        $next = $d->getrowvalue("id","select id from project_phrases where id not in (select phrases from project_phrases_status where u_id = {$u_id}) order by id asc limit 1 , 1",true);
        if (empty($next)) {
            $button = '
        <div class="float-left"><a href="index.php?action=tag&cancel=' . $id . '" class="btn btn-danger">Cancel</a></div>
        <div class="float-right"><a href="index.php?action=tag&confirmed=' . $id . '" class="btn btn-success">Confirmed</a></div>
        ';
        } else {
            $button = '
        <div class="float-left"><a href="index.php?action=tag&id=' . $next . '&cancel=' . $id . '" class="btn btn-danger">Cancel</a></div>
        <div class="float-right"><a href="index.php?action=tag&id=' . $next . '&confirmed=' . $id . '" class="btn btn-success">Confirmed</a></div>
        ';
        }
        $q = $d->query("select project_phrases_words.id,project_phrases_words.word from 
                                project_phrases_words,
                                project_phrases,
                                project_users 
                              where 
                                project_phrases_words.phrases = project_phrases.id and
                                project_phrases.project = project_users.project and 
                                project_phrases.id = {$id} and 
                                project_users.u_id=" . $u_id . " 
                              order by project_phrases_words.id asc");
        while ($row = $d->fetch($q)) {
            $hasEvent = $d->getrowvalue("type", "select `type` from project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.events = events.id and events.parent is null and word=" . $row['id'], true);
            $hasEntity = $d->getrowvalue("type", "select `type` from project_phrases_words_entities where u_id={$u_id} and word=" . $row['id'], true);
            if ($hasEvent == "B_") {
                $word_id = $d->getrowvalue("id", "select `id` from project_phrases_words_events where u_id={$u_id} and word=" . $row['id'], true);
                $inline_text = $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.word SEPARATOR ' ') as text from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and events.parent is null and (project_phrases_words_events.word=" . $row['id'] . " or project_phrases_words_events.parent=" . $word_id . ")", true);
                $inline_id = $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.id SEPARATOR ',') as text from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and events.parent is null and (project_phrases_words_events.word=" . $row['id'] . " or project_phrases_words_events.parent=" . $word_id . ")", true);
                $text .= '<span class="word-button-blue word-button" data-type="event" data-value="' . $inline_id . '">' . $inline_text . '</span> ';
            } elseif ($hasEntity == "B_") {
                $word_id = $d->getrowvalue("id", "select `id` from project_phrases_words_entities where u_id={$u_id} and word=" . $row['id'], true);
                $inline_text = $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.word SEPARATOR ' ') as text from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=" . $row['id'] . " or project_phrases_words_entities.parent=" . $word_id . ")", true);
                $inline_id = $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.id SEPARATOR ',') as text from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=" . $row['id'] . " or project_phrases_words_entities.parent=" . $word_id . ")", true);
                $text .= '<span class="word-button-green word-button" data-type="entity" data-value="' . $inline_id . '">' . $inline_text . '</span> ';
            } elseif (empty($hasEvent) and empty($hasEntity)) {
                $text .= '<span data-value="' . $row['id'] . '">' . $row['word'] . '</span> ';
            }
        }

// Entity Menu
        $entities_option = '';
        if ($ug_id < 3) {
            $q = $d->query("select * from entities where u_id={$u_id} and parent is null");
        } else {
            $q = $d->query("select * from entities where u_id={$parent_id} and parent is null");
        }
        while ($row = $d->fetch($q)) {
            $cnt = $d->getrowvalue("cnt", "select count(*) as cnt from entities where parent=" . $row['id'], true);
            if(!empty($row['des'])) $row['des'] = ' - '.$row['des'];
            if ($cnt > 0) {
                $entities_option .= '<menu label="' . $row['title'] . $row['des'] . '">';
                $qq = $d->query("select * from entities where parent=" . $row['id']);
                while ($res = $d->fetch($qq)) {
                    if(!empty($res['des'])) $res['des'] = ' - '.$res['des'];
                    $entities_option .= '<command label="' . $res['title'] . $res['des'] . '" onclick="rightClickCallback(' . $res['id'] . ',' . $id . ',\'entity\')"></command>';
                }
                $entities_option .= '</menu>';
            } else {
                $entities_option .= '<command label="' . $row['title'] . $row['des'] . '" onclick="rightClickCallback(' . $row['id'] . ',' . $id . ',\'entity\')"></command>';
            }
        }
        $entities_option = '<menu label="Entity">' . $entities_option . '</menu>';

//Events Menu
        $events_option = '';
        if ($ug_id < 3) {
            $q = $d->query("select * from events where parent is null and u_id=" . $u_id);
        } else {
            $q = $d->query("select * from events where parent is null and u_id=" . $parent_id);
        }
        while ($row = $d->fetch($q)) {
            if(!empty($row['des'])) $row['des'] = ' - '.$row['des'];
            $events_option .= '<command label="' . $row['title'] . $row['des'] . '" onclick="rightClickCallback(' . $row['id'] . ',' . $id . ',\'event\')"></command>';
        }
        $events_option = '<menu label="Events">' . $events_option . '</menu>';

// All Menu
        $menu = $entities_option . $events_option;
    }else{
        $content = '<div class="alert alert-danger" role="alert">Annotate Ended.</div>';
        $content_set = true;
    }
}
if($text == ""){
    if(!$content_set)
    $content = '<div class="alert alert-danger" role="alert">Permission Require</div>';
}else{
    $content = file_get_contents($action.".html");
    $content = str_replace(['[-text-]','[-menu-]','[-words-]','[-button-]'],[$text,$menu,"",$button],$content);
}