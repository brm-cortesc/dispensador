<?php
//error_reporting(E_ALL);
require("db/requires.php"); 
require_once("class/guardaTweet.php");
//ini_set('display_errors', '1');

$idHastag='4';

  $tweets = guardaTweet::traeTweets($idHastag);
  
?>