<?php
/** Author(s): Louis Taylor
 * Creation date: 12/23/2015
 */
 

header('Content-type: text/plain; charset=utf-8');
$IDDir = dirname(__FILE__);
include_once($IDDir . "/OrderData.php");
$Amt = -8;
$Field = 'AvailableAMT';
$product = 'TSHIRT1−SM';
//$product = utf8_encode($product);
//$product = 'TSHIRT1%E2%88%92SM';
$product = urlencode($product);
//$obj = DBConn::OpenDB();
OrderData::Update_inventory($Field, $Amt, $product);
//print_r($obj);
