<?php

/**
 * Stat view file
 * This is controller that call the model class Tool
 * 
 * @package Dogs
 * @name get_stat.php
 * @author Riadh Hamdi
 * 
 */

require 'includes/config.inc.php';
require 'includes/classi/CDatabase.php';
require 'includes/classi/CDogs.php';
require 'includes/classi/Tool.php';

$htmlToRender = "";

$maleDogId = $_REQUEST['dog1'];
$femaleDogId = $_REQUEST['dog2'];
$depth = $_REQUEST['depth'];

// Make sur the user has chossen a male and female
if( ($maleDogId != "") && ($femaleDogId != "") ){
    
    // Call the Tool class and get the result
    $tool = new Tool($maleDogId, $femaleDogId, $depth);
    $tool->go();
    $htmlToRender = $tool->get_result();
    
}else{
    
    // Put error message
    $htmlToRender = "You should chose a male and female.";
}

?>
