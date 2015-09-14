<?php
ini_set("display_errors",0);

require("db/requires.php");
//require("class/twitterSearch.php");
require_once("class/manejaTweets.php");
require_once("class/TwitterAPIExchange.php");

//https://api.twitter.com/1.1/search/tweets.json?q=+%23MiDiaDelCafe
$objeto = new ManejaTweets();
//$twitter = new TwitterAPIExchange($settings);
$twitter = new TwitterAPIExchange(array(
		'user_token' => "1511544307-JGKCwgz77aOEJFtIZVP4TbQCplgWlYQPAnD6nmw",
    'user_secret' => "MiXSqE7SDUkbKwF94NJ81BlYjP0CSYqwfDyxJ9j1js4kK",
    'consumer_key' => "jo2kzp7TzRGJB2KN0oQsm60hk",
    'consumer_secret' => "owJQa92VoDT56CFEk4zUZS6hvd4aAqj4tIgGF3EEUKhGcChb0p",
		'curl_ssl_verifypeer' => false
	));
$listadoHashtags = $objeto->getHashtags();
foreach($listadoHashtags as $key => $hashtag){

	$getfield = '%40'.$hashtag->tag;
  $twitter->request('GET',$twitter->url('1.1/search/tweets.json'),array('q' =>$getfield));
  $response = $twitter->response['response'];
	$resultsDecode = (object)json_decode($response, true);
	foreach($resultsDecode->statuses as $key => $value){
    $guardar = false;
		$objeto = new ManejaTweets();
		foreach($value as $llave => $valor){
      //if($llave=="source"){
        if(!stristr($value['source'], 'foursquare') === false){
          $guardar = true;
        }
      //}
      if($guardar){
        switch($llave){
          case "id":
            $objeto->tweet_id = $valor;
          break;
          case "user":
            foreach($valor as $llaveInt => $valorInt){
              //printVar($llaveInt, "llaveInt");
              switch($llaveInt){
                case "screen_name":
                  //printVar($valorInt, "@@@");

                  //$objeto->tweet_id = $valorInt;
                break;
              }
              $llaveInter = "user_".$llaveInt;
              //echo $llaveInter." = ".$valorInt."\n";
              $objeto->$llaveInter = $valorInt;
            }
          break;
          default:
            $objeto->$llave = $valor;
          break;
        }
      }
		}
    if($guardar){
      $fechaActual=date("Y-m-d");
      if($fechaActual>date("2014-09-01") && $fechaActual<=date("2014-09-15")){
          $objeto->quincena = "1";
      }
      if($fechaActual>date("2014-09-15") && $fechaActual<=date("2014-09-30")){
          $objeto->quincena = "2";
      }
      $objeto->idCuenta = $hashtag->id;
      $objeto->contado = "N";
      $guardaTwetter = $objeto->setTweetGeneral();
    }
	}
}
                
?>