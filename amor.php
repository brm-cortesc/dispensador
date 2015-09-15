<?php
//error_reporting(E_ALL);
require("db/requires.php"); 
require_once("class/guardaTweet.php");
//ini_set('display_errors', '1');

$idHastag='3';

  $tweets = guardaTweet::traeTweets($idHastag);
  


  $smarty->assign('tweets',$tweets);
	$smarty->display("amor.html"); 

?>