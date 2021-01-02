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