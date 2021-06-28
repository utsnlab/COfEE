<?php session_start();
include 'header.php';

require 'vendor/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;



$objPHPExcel =  WriterEntityFactory::createXLSXWriter();
$objPHPExcel->openToFile('../exports/result.xlsx');

$cellName = array('A','B','C','D','E','F','G');
$cellCount = 7;
$activeSheet = 0;
/*$objPHPExcel->getProperties()->setCreator("Excel Converter")
    ->setLastModifiedBy("Excel Converter")
    ->setTitle("Report")
    ->setSubject("Report")
    ->setDescription("Report")
    ->setKeywords("Report")
    ->setCategory("Report");
*/
$project_id = test_input($_GET['id']);
$q = $d->query("select u_id,username from project_users,user where project_users.u_id = user.id and project={$project_id} order by user.id asc");
while($row = $d->fetch($q)){
    //var_dump("alo");
    //var_dump($row['u_id']);
    //if($row['u_id']==31)
    //    continue;
    $cellNum =1;
    if($activeSheet > 0) {
        $curr_sheet = $objPHPExcel->addNewSheetAndMakeItCurrent();
    }
    else{
        $curr_sheet = $objPHPExcel->getCurrentSheet();
    }
    //$objPHPExcel->setActiveSheetIndex($activeSheet);
    $curr_sheet->setName($row['username']);
    $activeSheet++;
    $values = ['Word', 'POS', 'Entity_Value_Time', 'Event', 'Modality', 
    'Tense', 'Polarity', 'ID_Event', 'Argument'];
    $headers = WriterEntityFactory::createRowFromArray($values);
    $objPHPExcel->addRow($headers);
    /*$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Word');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'POS');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Entity_Value_Time');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Event');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Modality');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tense');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Polarity');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'ID_Event');
    $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Argument');*/
    $cellNum++;
    $qq = $d->query("select * from project_phrases,project_phrases_status where project_phrases.id = project_phrases_status.phrases and project_phrases_status.u_id=".$row['u_id']." and project_phrases_status.status=1 and project={$project_id} order by project_phrases.id asc");
    while($phrases = $d->fetch($qq)){
        try{
        if($cellNum > 2000){
            $curr_sheet = $objPHPExcel->addNewSheetAndMakeItCurrent();
            //$objPHPExcel->createSheet($activeSheet);
            //$objPHPExcel->setActiveSheetIndex($activeSheet);
            //$objPHPExcel->getActiveSheet()->setTitle($row['username']."_".$activeSheet);
            $curr_sheet->setName($row['username']."_".$activeSheet);
            $activeSheet++;
            $headers = WriterEntityFactory::createRowFromArray($values);
            $objPHPExcel->addRow($headers);
            /*$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Word');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', 'POS');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Entity_Value_Time');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Event');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Modality');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tense');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Polarity');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', 'ID_Event');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Argument');*/
            $cellNum = 2;
        }
        $i = 0;
        $data = [];
        $qqq = $d->query("select * from project_phrases_words where phrases = ".$phrases['id']." order by id asc");
        while ($words = $d->fetch($qqq)) {
            $args = $d->getrowvalue("title", "select  GROUP_CONCAT(CONCAT(project_phrases_words_entities.type, entities.title) ORDER BY title ASC SEPARATOR ', ') as title from entities,project_phrases_words_entities where entities.id = project_phrases_words_entities.entity and project_phrases_words_entities.u_id = ".$row['u_id']." and project_phrases_words_entities.word=" . $words['id'], true);
            $event = $d->getrowvalue("title", "select GROUP_CONCAT(CONCAT(project_phrases_words_events.type, events.title) ORDER BY title ASC SEPARATOR ', ') as title from events,project_phrases_words_events where events.id = project_phrases_words_events.events and project_phrases_words_events.u_id = ".$row['u_id']." and project_phrases_words_events.word=" . $words['id'], true);
            $asserted = $d->getrowvalue("title", "select GROUP_CONCAT(project_phrases_words_events.asserted ORDER BY title ASC SEPARATOR ', ') as title from events,project_phrases_words_events where events.id = project_phrases_words_events.events and project_phrases_words_events.u_id = ".$row['u_id']." and project_phrases_words_events.word=" . $words['id'], true);
            $tens = $d->getrowvalue("title", "select GROUP_CONCAT(project_phrases_words_events.tens ORDER BY title ASC SEPARATOR ', ') as title from events,project_phrases_words_events where events.id = project_phrases_words_events.events and project_phrases_words_events.u_id = ".$row['u_id']." and project_phrases_words_events.word=" . $words['id'], true);
            $polarity = $d->getrowvalue("title", "select GROUP_CONCAT(project_phrases_words_events.polarity ORDER BY title ASC SEPARATOR ', ') as title from events,project_phrases_words_events where events.id = project_phrases_words_events.events and project_phrases_words_events.u_id = ".$row['u_id']." and project_phrases_words_events.word=" . $words['id'], true);
            $event_id = $d->getrowvalue("title", "select GROUP_CONCAT(events.id ORDER BY title ASC SEPARATOR ', ') as title from events,project_phrases_words_events where events.id = project_phrases_words_events.events and project_phrases_words_events.u_id = ".$row['u_id']." and project_phrases_words_events.word=" . $words['id'], true);
            $data[$i]['word'] = $words['word'];
            if ($args == "") {
                $data[$i]['arg'] = "O";
            } else {
                $phrase_entity_word = $d->fetch($d->query("select  * from project_phrases_words_entities where project_phrases_words_entities.u_id = ".$row['u_id']." and project_phrases_words_entities.word=" . $words['id'], true));
                $args_id = $phrase_entity_word['entity'];
                $entity_parent_id = $phrase_entity_word['parent'];
                if(empty($entity_parent_id)){
                    $entity_parent_id = $phrase_entity_word['id'];
                }
                $data[$i]['arg'] = '(' . $args . ', EN_' . $row['u_id'] . '_' . $entity_parent_id . '_' . $args_id . ')';
            }
            if ($event == "") {
                $data[$i]['event'] = "O";
            } else {
                $phrase_event_word = $d->fetch($d->query("select  * from project_phrases_words_events where project_phrases_words_events.u_id = ".$row['u_id']." and project_phrases_words_events.word=" . $words['id'], true));
                $args_id = $phrase_event_word['event'];
                $parent_id_for_event = $phrase_event_word['parent'];
                if(empty($parent_id_for_event)){
                    $parent_id_for_event = $phrase_event_word['id'];
                }
                $data[$i]['event'] = '(' . $event . ', EV_' . $row['u_id'] . '_' . $parent_id_for_event . '_' . $phrase_event_word['events'] . ')';
            }

            $data[$i]['role'] = "";
            $aq = $d->query("select * from project_phrases_words_arguments where u_id = ".$row['u_id']." and word=" . $words['id'] . " order by id asc");
            while ($argument = $d->fetch($aq)) {
                $role = $d->getrowvalue("title", "select GROUP_CONCAT(CONCAT(project_phrases_words_arguments.type, arguments.title) ORDER BY title ASC SEPARATOR ', ') as title from arguments,project_phrases_words_arguments where arguments.id = project_phrases_words_arguments.argument and project_phrases_words_arguments.id = " . $argument['id'], true);

                if ($role == "") {
                    $data[$i]['role'] .= "O";
                } else {
                    $phrase_event_word = $d->fetch($d->query("select  * from project_phrases_words_events where project_phrases_words_events.u_id = ".$argument['u_id']." and project_phrases_words_events.id=" . $argument['event'], true));
                    $args_id = $phrase_event_word['event'];
                    $event_parent_id = $phrase_event_word['parent'];
                    if(empty($event_parent_id)){
                        $event_parent_id = $phrase_event_word['id'];
                    }
                    $ev_id = $d->getrowvalue("events", "select  events from project_phrases_words_events where project_phrases_words_events.u_id = ".$argument['u_id']." and id=" . $argument['event'], true);
                    $ev_word = $d->getrowvalue("word", "select  word from project_phrases_words_events where project_phrases_words_events.u_id = ".$argument['u_id']." and id=" . $argument['event'], true);
                    $data[$i]['role'] .= '(' . $role . ',' . 'EV_' . $row['u_id'] . '_' .
                        $event_parent_id . '_' . $ev_id . ',' . 'EN_' . $row['u_id'] . '_' . $entity_parent_id . '_' . $phrase_entity_word['entity'] . ')';
                }
            }
            if ($event_id == "") {
                $data[$i]['event_id'] = "O";
            } else {
                $data[$i]['event_id'] = 'EV_' . $row['u_id'] . '_' . $parent_id_for_event . '_' . $phrase_event_word['events'];
            }
            if($asserted == ""){
                $data[$i]['asserted'] = "O";
            }else{
                $data[$i]['asserted'] = $asserted ;
            }
            if($tens == ""){
                $data[$i]['tens'] = "O";
            }else{
                $data[$i]['tens'] = $tens;
            }
            if($polarity == ""){
                $data[$i]['polarity'] = "O";
            }else{
                $data[$i]['polarity'] = $polarity;
            }
            $i++;
        }
        /*$objPHPExcel->getActiveSheet()->setCellValue('A' . $cellNum, '<project id="' . $project_id . '>');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cellNum, $phrases['link']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cellNum, $phrases['time']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cellNum, '');*/
        $row_values = ['<project id="' . $project_id . '>', $phrases['link'], $phrases['time'], '', '', 
        '', '', '', ''];
        $tmp_row_data = WriterEntityFactory::createRowFromArray($row_values);
        $objPHPExcel->addRow($tmp_row_data);
        ///
        $cellNum++;
        /*$objPHPExcel->getActiveSheet()->setCellValue('A' . $cellNum, '<s id="'. $phrases['id'] . '">');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cellNum, 'begin');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cellNum, 'O');*/
        $row_values = ['<s id="'. $phrases['id'] . '">', 'begin', 'O', 'O', 'O', 
        'O', 'O', 'O', 'O'];
        $tmp_row_data = WriterEntityFactory::createRowFromArray($row_values);
        $objPHPExcel->addRow($tmp_row_data);
        ///
        $cellNum++;
        foreach ($data as $dataa) {
            /*$objPHPExcel->getActiveSheet()->setCellValue('A' . $cellNum, $dataa['word']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cellNum, $dataa['pos']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cellNum, $dataa['arg']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cellNum, $dataa['event']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cellNum, $dataa['asserted']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cellNum, $dataa['tens']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cellNum, $dataa['polarity']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $cellNum, $dataa['event_id']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $cellNum, $dataa['role']);*/
            $row_values = [$dataa['word'], $dataa['pos'], $dataa['arg'], $dataa['event'], $dataa['asserted'], 
            $dataa['tens'], $dataa['polarity'], $dataa['event_id'], $dataa['role']];
            $tmp_row_data = WriterEntityFactory::createRowFromArray($row_values);
            $objPHPExcel->addRow($tmp_row_data);
            ///
            $cellNum++;
        }
        /*$objPHPExcel->getActiveSheet()->setCellValue('A' . $cellNum, '</s>');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cellNum, 'end');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cellNum, 'O');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cellNum, 'O');*/
        $row_values = ['</s>', 'end', 'O', 'O', 'O', 
        'O', 'O', 'O', 'O'];
        $tmp_row_data = WriterEntityFactory::createRowFromArray($row_values);
        $objPHPExcel->addRow($tmp_row_data);
        ///
        $cellNum++;
        /*$objPHPExcel->getActiveSheet()->setCellValue('A' . $cellNum, '</project>');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cellNum, '');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cellNum, '');*/
        $row_values = ['</project>', '', '', '', '', 
        '', '', '', ''];
        $tmp_row_data = WriterEntityFactory::createRowFromArray($row_values);
        $objPHPExcel->addRow($tmp_row_data);
        ////
    }
    catch(Throwable $e){
        var_dump($e);
    }
    }

}
1+1;
/*if (!PHPExcel_Settings::setPdfRenderer(
    $rendererName,
    $rendererLibraryPath
)) {
    die(
        'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
        '<br />' .
        'at the top of this script as appropriate for your directory structure'
    );
}
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Report.xls"');*/
//echo "here";
//var_dump("end");
/*try{$writer = new Xlsx($objPHPExcel);
    $writer->save('../exports/result.xlsx');
    $attachment_location = '/var/www/exports' . "/result.xlsx";}
catch(Throwable $e){var_dump($e);}
*/
$objPHPExcel->close();
$attachment_location = '/var/www/exports' . "/result.xlsx";
if (file_exists($attachment_location)) {

    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for internet explorer
    header("Content-Type: application/xlsx");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:".filesize($attachment_location));
    header("Content-Disposition: attachment; filename=result.xlsx");
    readfile($attachment_location);
    die();        
} else {
    die("Error: File not found.");
} 
//echo "done";
return;
//exit;
