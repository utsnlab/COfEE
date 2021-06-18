<?php

$using_lang = $_SESSION['using_lang'];
$status = true;
if (isset($_GET['confirmed'])) {
    if (is_numeric($_GET['confirmed'])) {
        $confirmed = test_input($_GET['confirmed']);
        $d->query("delete from project_phrases_status where u_id={$u_id} and phrases={$confirmed}");
        $d->iquery("project_phrases_status", ['u_id' => $u_id, 'phrases' => $confirmed, 'status' => 1]);
    } else {
        $status = false;
    }
}
if (isset($_GET['cancel'])) {
    if (is_numeric($_GET['cancel'])) {
        $cancel = test_input($_GET['cancel']);
        $d->query("delete from project_phrases_status where u_id={$u_id} and phrases={$cancel}");
        $d->iquery("project_phrases_status", ['u_id' => $u_id, 'phrases' => $cancel, 'status' => 2]);
        $d->query("update project_phrases set num_of_visit=num_of_visit+1 where id={$cancel}");
    } else {
        $status = false;
    }
}
if ($status) {
    $id = test_input($_GET['id']);
    if (!empty($id)) {
        $status = $d->getrowvalue("status","select status from project_phrases_status where phrases={$id} and u_id={$u_id}",true);
        if(empty($status)) {
            //$d->query("update project_phrases set num_of_visit = num_of_visit-1 where id = {$id}");
            $d->query("delete from project_phrases_status where u_id={$u_id} and phrases={$id}");
            $d->iquery("project_phrases_status", ['u_id' => $u_id, 'phrases' => $id, 'status' => 3]);
        }
        $_SESSION['user']['rtl'] = $d->getrowvalue("rtl", "select rtl, projects.id from project_phrases,projects where project_phrases.project = projects.id and project_phrases.id={$id}", true);
        $project = $d->getrowvalue("p_id", "select rtl, projects.id as p_id from project_phrases,projects where project_phrases.project = projects.id and project_phrases.id={$id}", true);
        $next = $d->getrowvalue("id", "select id from project_phrases where project = {$project} and num_of_visit > 0 and id not in (select phrases from project_phrases_status where status in (1, 2) and u_id={$u_id}) order by id asc limit 1 , 1", true);
        $d->query("update project_phrases set num_of_visit = num_of_visit-1 where id = {$next}");
        if (empty($next)) {
            $button = '
        <div class="float-left"><a href="index.php?action=tag&cancel=' . $id . '" class="btn btn-danger">'.$CANCEL[$using_lang].'</a></div>
        <div class="float-right"><a href="index.php?action=tag&confirmed=' . $id . '" class="btn btn-success">'.$CONFIRM[$using_lang].'</a></div>
        ';
        } else {
            $button = '
        <div class="float-left"><a href="index.php?action=tag&id=' . $next . '&cancel=' . $id . '" class="btn btn-danger">'.$CANCEL[$using_lang].'</a></div>
        <div class="float-right"><a href="index.php?action=tag&id=' . $next . '&confirmed=' . $id . '" class="btn btn-success">'.$CONFIRM[$using_lang].'</a></div>
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
            $hasEvent = $d->getrowvalue("type", "select `type` from project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.events = events.id and word=" . $row['id'], true);
            $hasEntity = $d->getrowvalue("type", "select `type` from project_phrases_words_entities where u_id={$u_id} and word=" . $row['id'], true);
            if ($hasEvent == "B_") {
                $word_id = $d->getrowvalue("id", "select `id` from project_phrases_words_events where u_id={$u_id} and word=" . $row['id'], true);
                $inline_text = "";
                if ($_SESSION['user']['rtl']){
                    $wd = $d->query("select project_phrases_words.word from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and (project_phrases_words_events.word=" . $row['id'] . " or project_phrases_words_events.parent=" . $word_id . ") order by project_phrases_words.id asc", true);
                    while ($wr = $d->fetch($wd))
                        $inline_text .= $wr["word"] . " ";
                }
                else{
                    $wd = $d->query("select project_phrases_words.word from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and (project_phrases_words_events.word=" . $row['id'] . " or project_phrases_words_events.parent=" . $word_id . ") order by project_phrases_words.id asc", true);
                    while ($wr = $d->fetch($wd))
                        $inline_text .= $wr["word"] . " ";
                }
                $inline_text = rtrim($inline_text, " ");
//                $inline_text = $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.word SEPARATOR ' ') as text from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and (project_phrases_words_events.word=" . $row['id'] . " or project_phrases_words_events.parent=" . $word_id . ")", true);
                $inline_id =   $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.id SEPARATOR ',') as text from project_phrases_words,project_phrases_words_events,events where project_phrases_words_events.u_id={$u_id} and project_phrases_words_events.word = project_phrases_words.id and project_phrases_words_events.events = events.id and (project_phrases_words_events.word=" . $row['id'] . " or project_phrases_words_events.parent=" . $word_id . ")", true);
                $text .= '<span class="word-button-blue word-button" data-type="event" data-value="' . $inline_id . '">' . $inline_text . '</span> ';
            } elseif ($hasEntity == "B_") {
                $word_id = $d->getrowvalue("id", "select `id` from project_phrases_words_entities where u_id={$u_id} and word=" . $row['id'], true);
                $inline_text = "";
                if ($_SESSION['user']['rtl']){
                    $wd = $d->query("select project_phrases_words.word from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=" . $row['id'] . " or project_phrases_words_entities.parent=" . $word_id . ") order by project_phrases_words.id asc", true);
                    while ($wr = $d->fetch($wd))
                        $inline_text .= $wr["word"] . " ";
                }
                else{
                    $wd = $d->query("select project_phrases_words.word from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=" . $row['id'] . " or project_phrases_words_entities.parent=" . $word_id . ") order by project_phrases_words.id asc", true);
                    while ($wr = $d->fetch($wd))
                        $inline_text .= $wr["word"] . " ";
                }
                $inline_text = rtrim($inline_text, " ");
//                $inline_text = $d->getrowvalue("text", "select GROUP_CONCAT(project_phrases_words.word SEPARATOR ' ') as text from project_phrases_words,project_phrases_words_entities where project_phrases_words_entities.u_id={$u_id} and project_phrases_words_entities.word = project_phrases_words.id and (project_phrases_words_entities.word=" . $row['id'] . " or project_phrases_words_entities.parent=" . $word_id . ")", true);
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
        $row_key = 'title';
        if($using_lang == 'fa'){
            $row_key = 'des';
        }
        while ($row = $d->fetch($q)) {
            $cnt = $d->getrowvalue("cnt", "select count(*) as cnt from entities where parent=" . $row['id'], true);
            if (!empty($row[$row_key])) $row[$row_key] = $row[$row_key];
            if ($cnt > 0) {
                $entities_option .= '<menu label="' . $row[$row_key] . '">';
                $qq = $d->query("select * from entities where parent=" . $row['id']);
                while ($res = $d->fetch($qq)) {
                    if (!empty($res[$row_key])) $res[$row_key] = $res[$row_key];
                    $entities_option .= '<command label="' . $res[$row_key] . '" onclick="rightClickCallback(' . $res['id'] . ',' . $id . ',\'entity\')"></command>';
                }
                $entities_option .= '</menu>';
            } else {
                $entities_option .= '<command label="' . $row[$row_key] . '" onclick="rightClickCallback(' . $row['id'] . ',' . $id . ',\'entity\')"></command>';
            }
        }
        $entities_option = '<menu label='.$ENTITY[$using_lang].'>' . $entities_option . '</menu>';

//Events Menu
        $events_option = '';
        if ($ug_id < 3) {
            $q = $d->query("select * from events where parent is null and u_id=" . $u_id);
        } else {
            $q = $d->query("select * from events where parent is null and u_id=" . $parent_id);
        }
        while ($row = $d->fetch($q)) {
            $cnt = $d->getrowvalue("cnt", "select count(*) as cnt from events where parent=" . $row['id'], true);
            if (!empty($row[$row_key])) $row[$row_key] = $row[$row_key];
            if ($cnt > 0) {
                $events_option .= '<menu label="' . $row[$row_key] . '">';
                $qq = $d->query("select * from events where parent=" . $row['id']);
                while ($res = $d->fetch($qq)) {
                    //if (!empty($res[$row_key])) $res[$row_key] = $res[$row_key];
                    $events_option .= '<command phrase_id="'.$id.'" event_id="'. $res['id'] .'" label="' . $res[$row_key] . '" onclick="rightClickCallback(' . $res['id'] . ',' . $id . ',\'event\')"></command>';
                }
                $events_option .= '</menu>';
            } else {
                $events_option .= '<command label="' . $row[$row_key] . '" onclick="rightClickCallback(' . $row['id'] . ',' . $id . ',\'event\')"></command>';
            }
        }
        $events_option = '<menu label='.$EVENT[$using_lang].'>' . $events_option . '</menu>';

// All Menu
        $menu = $entities_option . $events_option;
    } else {
        $content = '<div class="alert alert-danger" role="alert">Annotate Ended.</div>';
        $content_set = true;
    }
}
if ($text == "") {
    if (!$content_set)
        $content = '<div class="alert alert-danger" role="alert">Permission Require</div>';
} else {
    $content = file_get_contents($action . ".html");
    $content = str_replace(['[-text-]', '[-menu-]', '[-words-]', '[-button-]'], [$text, $menu, "", $button], $content);
}