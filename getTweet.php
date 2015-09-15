<?php

/*function printVar( $variable, $title = "" ){
  $var = print_r( $variable, true );
  echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}*/
require("db/requires.php");


ini_set("display_errors",1);

//require("class/twitterSearch.php");
require_once("class/manejaTweets.php");
require_once("class/TwitterAPIExchange.php");
require_once("class/guardaTweet.php");


/*Hash temporales*/

$comparte="PruebasBRM";
$amistad="NoEsPorPresumir";

//https://api.twitter.com/1.1/search/tweets.json?q=+%23MiDiaDelCafe
$objeto = new ManejaTweets();
/*$twitter = new TwitterAPIExchange($settings);*/
$settings = array(
		'oauth_access_token' => "750495828-baTY248IdSib8LMsnjTGel2WTgFcMGiemMGRWNxw",
    'oauth_access_token_secret' => "eUbahLx3FaJbqlbGUZYxKFGU26T9wUnm7ZmH5n81cirdI",
    'consumer_key' => "WDTlXe9etTsofPrDtZskFzKwf",
    'consumer_secret' =>"YTQp3f2KLC02pTMylDDkfGPVEYq1u886p8FDBdpZHUTTrMNuVT"
	);


  $idHastag='3';

  $lastId = guardaTweet::traeIdFin($idHastag);
  printVar($lastId);

/*$hashtag->tag*/
	 $dateBgin='2015';
   $dateEnd='';
   $termino='';
   $hashtag=$comparte;
   $usuario='';
   $requestMethod = 'GET';
   $ultimoidFinal=''; 
  //Asignación de url para búsqueda
  $Campos =$objeto->ruta($dateBgin,$termino,$hashtag,$lastId,$usuario);
  /*printVar($Campos);
  die();*/
  /*Traer el último idTweet para traer los tweets nuevos con idHastag*/



   $url=$Campos[0];
   $getfield=$Campos[1];

   //printVar($getfield);
   //printVar($getfield);
   //$satusApi=$Campos[2];
   $twitter = new TwitterAPIExchange($settings);
   $decodificacion=$objeto->peticionsrv($twitter,$getfield,$lastId,$url,$requestMethod);
   printVar($decodificacion);

  //
     # code...
   $value=$decodificacion['statuses'];
    $total=count($value);
    //echo $total;

    
    for ($i=0; $i < $total; $i++) { 
      //printVar($value[$i]);
      $idTweet=$value[$i]['id_str'];
      $tweet=$value[$i]['text'];
      $arroa=$value[$i]['user']['screen_name'];
      $nombreUsuario=$value[$i]['user']['name'];
      $avatar=$value[$i]['user']['profile_image_url'];


      $campos["idHashtag"]='3';
      $campos["idTweet"]=$idTweet;
      $campos["arroba"]=$arroa;
      $campos["nombreUsuario"]=$nombreUsuario;
      $campos["tweet"]=$tweet;
      $campos["avatar"]=$avatar;


      $guardarTweet = guardaTweet::InsertarTweet($campos);

      
      
      //die();
    }
    
    die();
  //
   //printVar($decodificacion['statuses']);

   //printVar($idTweet);
    
   $contador=1;
   
    //Index of de URL, para saber que parte del API va a ser utilizada
    if(strrpos($url,"user_timeline")>0){
      //Fetch de status en un timeline
      $userTimeLine=$objeto->userTimeFtch($url,$usuario,$decodificacion,$twitter,$requestMethod);
    }else if(strrpos($url,"search/tweets")>0){
      //Fetch de tweets de acuerdo a hashtag o terminos.
      //printVar(1);
      $terms=$objeto->searchFtch($url,$dateBgin,$termino,$hashtag,$decodificacion,$twitter,$requestMethod);
    }
   
                
?>