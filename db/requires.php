<?php

ini_set("display_errors","1");
error_reporting(E_ALL ^ E_STRICT);
//session_start();
/*$_SESSION['email']="HOLA";*/

global $prefijo;

// require("./".$prefijo."db/DBO.php");

//	DataObjects
// require("./".$prefijo."db/requires.ini.php");

//	Clases
global $prefijo;
$prefijo="";

// incluir Smarty
require("../Smarty/libs/Smarty.class.php");
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->left_delimiter = '{#';
$smarty->right_delimiter = '#}';

function cambiaParaEnvio($cadena){
	//$cadena = htmlentities($cadena,ENT_NOQUOTES,"ISO8859-1");
	$cadena = utf8_encode($cadena);
	return($cadena);
}

function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}

?>