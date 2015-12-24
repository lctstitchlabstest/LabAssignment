<?php
include_once($IDDir . "/CommandFactory.php");



//  Driving script

$filedata = file_get_contents('./text.txt', true);
$filearray = explode("\n", $filedata);
$wordarray = array();

foreach($filearray as $filetext)
    {
    $filetextarray = explode(' ', $filetext);	
	CommandFactory::injectOrder($Object, $orderString);
    }
