<?php 
//session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$msgErrosenhaIgual = true;

require('controller/Controle.php');

if (!isset($controller)){
	$controller = new Controle();

}else {
	$controller->inicializador();
}
?>