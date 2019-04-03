<?php 
//session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include ('controller/Control.php');

if (!isset($controller)){
	$controller = new Control();
	$controller->init();
}else
	$controller->init();

?>