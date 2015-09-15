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


//https://api.twitter.com/1.1/search/tweets.json?q=+%23MiDiaDelCafe
$objeto = new ManejaTweets();
/*$twitter = new TwitterAPIExchange($settings);*/
$settings = array(
		'oauth_access_token' => "750495828-baTY248IdSib8LMsnjTGel2WTgFcMGiemMGRWNxw",
    'oauth_access_token_secret' => "eUbahLx3FaJbqlbGUZYxKFGU26T9wUnm7ZmH5n81cirdI",
    'consumer_key' => "WDTlXe9etTsofPrDtZskFzKwf",
    'consumer_secret' =>"YTQp3f2KLC02pTMylDDkfGPVEYq1u886p8FDBdpZHUTTrMNuVT"
	);
$hastagT = guardaTweet::traeHastag();







foreach ($hastagT as $key => $hash) {
  # code...


$idHastag=$hash->id;
$tag=$hash->hashtag;

printVar($idHastag);
printVar($tag);



  

  $lastId = guardaTweet::traeIdFin($idHastag);
  //printVar($lastId);

/*$hashtag->tag*/
	 $dateBgin='2015';
   $dateEnd='';
   $termino='';
   $hashtag=$tag;
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
   //printVar($decodificacion);


  //
     # code...
   $value=$decodificacion['statuses'];
   printVar($value);
    $total=count($value);
    //echo $total;
  if(empty($value)){

    echo('No hay tweet');
    sleep(1); 
   

  }else{
    
     /*Recorre los datos de los tweets traidos por el ht*/
    for ($i=0; $i < $total; $i++) { 
      //printVar($value[$i]);
      $idTweet=$value[$i]['id_str'];
      $tweet=$value[$i]['text'];
      $arroa=$value[$i]['user']['screen_name'];
      $nombreUsuario=$value[$i]['user']['name'];
      $avatar=$value[$i]['user']['profile_image_url'];


      $campos["idHashtag"]=$idHastag;
      $campos["idTweet"]=$idTweet;
      $campos["arroba"]=$arroa;
      $campos["nombreUsuario"]=$nombreUsuario;
      $campos["tweet"]=$tweet;
      $campos["avatar"]=$avatar;


      $guardarTweet = guardaTweet::InsertarTweet($campos);
      sleep(1);      
      //die();
    }
  }


  
    
  }
   
                
?>