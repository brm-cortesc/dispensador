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
   //printVar($value);
    $total=count($value);
    //echo $total;
  if(empty($value)){

    echo('No hay tweet');
    sleep(1); 
   

  }else{
    
     /*Recorre los datos de los tweets traidos por el ht*/
    for ($i=0; $i < $total; $i++) { 
      printVar($value[$i]);
      $idTweet=$value[$i]['id_str'];
      $idTweetInt=(int)$value[$i]['id'];
      $tweet=$value[$i]['text'];
      $arroa=$value[$i]['user']['screen_name'];
      $nombreUsuario=$value[$i]['user']['name'];
      $avatar=$value[$i]['user']['profile_image_url'];
      $source=$value[$i]['source'];
      /*Hasta acá cargaba avatard de  tw*/
      $truncate=$value[$i]['truncated'];
      $idUsuario=$value[$i]['user']['id'];
      $idUsuarioStr=$value[$i]['user']['id_str'];
      $location=$value[$i]['user']['location'];
      $description=$value[$i]['user']['description'];
      $url=$value[$i]['user']['url'];
      $protected=$value[$i]['user']['protected'];
      $followers_count=$value[$i]['user']['followers_count'];
      $friends_count=$value[$i]['user']['friends_count'];
      $listed_count=$value[$i]['user']['listed_count'];
      $created_at=$value[$i]['user']['created_at'];
      $favourites_count=$value[$i]['user']['favourites_count'];
      $utc_offset=$value[$i]['user']['utc_offset'];
      $time_zone=$value[$i]['user']['time_zone'];
      $geo_enabled=$value[$i]['user']['geo_enabled'];
      $verified=$value[$i]['user']['verified'];
      $statuses_count=$value[$i]['user']['statuses_count'];
      $lang=$value[$i]['user']['lang'];
      $contributors_enabled=$value[$i]['user']['contributors_enabled'];
      $is_translator=$value[$i]['user']['is_translator'];
      $is_translation_enabled=$value[$i]['user']['is_translation_enabled'];
      $has_extended_profile=$value[$i]['user']['has_extended_profile'];
      $default_profile=$value[$i]['user']['default_profile'];
      $following=$value[$i]['user']['following'];
      $follow_request_sent=$value[$i]['user']['follow_request_sent'];
      $in_reply_to_status_id=$value[$i]['in_reply_to_status_id'];
      $in_reply_to_status_id_str=$value[$i]['in_reply_to_status_id_str'];
      $in_reply_to_user_id=$value[$i]['in_reply_to_user_id'];
      $in_reply_to_user_id_str=$value[$i]['in_reply_to_user_id_str'];
      $in_reply_to_screen_name=$value[$i]['in_reply_to_screen_name'];
      $default_profile_image=$value[$i]['user']['default_profile_image'];

      /*Traer la imagen del avatar grande*/
      $avatar=str_replace('_normal','',$avatar);

      $campos["idHashtag"]=$idHastag;
      $campos["idTweet"]=$idTweet;
      $campos["arroba"]=$arroa;
      $campos["nombreUsuario"]=$nombreUsuario;
      $campos["tweet"]=$tweet;
      $campos["avatar"]=$avatar;
      /*Nuevos campos*/
      $campos['idUsuario']=$idUsuario;
      $campos["idTweetInt"]=$idTweetInt;
      $campos['idUsuarioStr']=$idUsuarioStr;
      $campos['location']=$location;
      $campos['description']=$description;
      $campos['source']=$source;
      $campos['truncated']=$truncate;
      $campos['url']=$url;
      $campos['protected']=$protected;
      $campos['followers_count']=$followers_count;
      $campos['friends_count']=$friends_count;
      $campos['listed_count']=$listed_count;
      $campos['created_at']=$created_at;
      $campos['favourites_count']=$favourites_count;
      $campos['utc_offset']=$utc_offset;
      $campos['time_zone']=$time_zone;
      $campos['geo_enabled']=$geo_enabled;
      $campos['verified']=$verified;
      $campos['statuses_count']=$statuses_count;
      $campos['lang']=$lang;
      $campos['contributors_enabled']=$contributors_enabled;
      $campos['is_translator']=$is_translator;
      $campos['is_translation_enabled']= $is_translation_enabled;
      $campos['has_extended_profile']=$has_extended_profile;
      $campos['default_profile']=$default_profile;
      $campos['following']=$following;
      $campos['follow_request_sent']=$follow_request_sent;
      $campos['notifications']=$notifications;
      $campos['in_reply_to_status_id']=$in_reply_to_status_id_str;
      $campos['in_reply_to_status_id_str']=$in_reply_to_user_id;
      $campos['in_reply_to_user_id']=$in_reply_to_user_id_str;
      $campos['in_reply_to_user_id_str']=$in_reply_to_screen_name;
      $campos['in_reply_to_screen_name']=$in_reply_to_screen_name;
      $campos['default_profile_image']=$default_profile_image;

      $guardarTweet = guardaTweet::InsertarTweet($campos);
      sleep(1);      
      //die();
    }
  }


  
    
  }
   
                
?>