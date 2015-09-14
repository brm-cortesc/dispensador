<?php

class ManejaTweets
{
	//Función para insertar un registro
	function setTweet($tabla = "Tweet"){

		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		// Trae los campos de la tabla usuario;
		$campos = $objDBO->table();
		unset($campos["fecha"]);
		unset($campos["id"]);

		$resultado = false;
		foreach($campos as $key => $value){
			//$objDBO->$key = utf8_decode($this->$key);
			$objDBO->$key = $this->$key;
		}
		$objDBO->fecha = date("Y-m-d H:i:s");

		//Inserta el objeto DBO
		$ret = $objDBO->insert();
		
		//Libera el objeto DBO
		$objDBO->free();
		
		return($ret);
		
	}
	
	//Función envía Lamparazo
	function sendTweet($tabla = "Tweet"){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
		$objDBO->publicado = 'N';
		
		$ret = false;
		$objDBO->find();
		if($objDBO->fetch()){
			$ret = true;
			$obj2DBO = DB_DataObject::Factory($tabla);
			
			$obj2DBO->get($objDBO->id);
			$obj2DBO->publicado = 'S';
			$obj2DBO->update();
			
			$obj2DBO->free();
			
			$this->profile_image_url = $objDBO->profile_image_url;
		}
		$objDBO->free();
		
		return($ret);
	}
	
	//Función trae los hashtag a buscar
	function getHashtags($tipo="TweetHashtag"){
		//Crea una nueva instancia de Hashtag a partir de DataObject
		$objDBO = DB_DataObject::Factory($tipo);
		
		$campos = $objDBO->table();
		
		$ret = false;
		$objDBO->find();
		$resultados = array();
		$contador = 0;
		
		while($objDBO->fetch()){
			$ret = true;
			//Asigna los valores
			foreach($campos as $key => $value){
				$resultados[$contador]->$key = $objDBO->$key;
			}
			$contador++;
		}
		
		if($ret){
			$ret = $resultados;
		}
		
		$objDBO->free();
		//$ret='OldSpiceLA';
		
		return($ret);
	}

	//Función para insertar un registro
	function setTweetGeneral($tipo="TweetGeneral"){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory($tipo);
		// Trae los campos de la tabla usuario;
		$campos = $objDBO->table();
		unset($campos["fecha"]);
		unset($campos["id"]);
		
		unset($campos["geo"]);
		unset($campos["coordinates"]);
		unset($campos["place"]);
		unset($campos["contributors"]);
  		
		$resultado = false;
		$i=0;
		foreach($campos as $key => $value){

			$i++;
/*			printVar($key);
			printVar($this->$key);
			if ($i==4) {
				die;
			}*/
			
/*			echo $key;
			$objDBO->$key = utf8_decode($this->$key);*/
			$objDBO->$key = (isset($this->$key)!="")?utf8_decode($this->$key):'';
		}
		$objDBO->fecha = date("Y-m-d H:i:s");

		//Inserta el objeto DBO
		$ret = $objDBO->insert();
		
		//Libera el objeto DBO
		$objDBO->free();
		
		return($ret);
		
	}
	
	//Función para insertar un registro
	function setPostGeneral($tipo="TweetGeneral"){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory($tipo);
		// Trae los campos de la tabla usuario;
		$campos = $objDBO->table();
		unset($campos["fecha"]);
		unset($campos["id"]);
		
		$objDBO->fb_id = utf8_decode($this->fb_id);
		$objDBO->find();
		if($objDBO->fetch()){
			$ret = $objDBO->id;
			$objDBO = DB_DataObject::Factory($tipo);
			$objDBO->get($ret);
		}else{
			$ret = false;
		}
		
		$resultado = false;
		foreach($campos as $key => $value){
			$objDBO->$key = utf8_decode($this->$key);
			//$objDBO->$key = $this->$key;
		}
		$objDBO->fecha = date("Y-m-d H:i:s");
		
		
		if($ret!==false){
			//Inserta el objeto DBO
			$ret = $objDBO->update();
		}else{
			//Inserta el objeto DBO
			$ret = $objDBO->insert();
		}
		
		//Libera el objeto DBO
		$objDBO->free();
		
		return($ret);
		
	}
	
	//Función envía Pulso
	function sendTweetGeneral($idHashtag = 1){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory("TweetGeneral");
		$objDBO->publicado = 'N';
		$objDBO->idHashtag = $idHashtag;
		
		$ret = false;
		$campos = $objDBO->table();
		$objDBO->find();
		if($objDBO->fetch()){
			$ret = true;
			$obj2DBO = DB_DataObject::Factory("TweetGeneral");
			
			$obj2DBO->get($objDBO->id);
			$obj2DBO->publicado = 'S';
			$obj2DBO->update();
			
			$obj2DBO->free();
			
			//$this->profile_image_url = $objDBO->profile_image_url;
			foreach($campos as $key => $value){
				$this->datosTweet->$key = cambiaParaEnvio(utf8_decode($objDBO->$key));
			}
			//$this->datosTweet = $objDBO;
			
			
		}
		$objDBO->free();
		
		return($ret);
	}
	
	//Función Trae el último Tweet Publicado
	function getUltimoTweet($idHashtag = 1){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory("TweetGeneral");
		$objDBO->publicado = 'S';
		$objDBO->idHashtag = $idHashtag;
		
		$objDBO->orderBy("id DESC");
		$objDBO->limit(1);
		
		$ret = false;
		$campos = $objDBO->table();
		$objDBO->find();
		if($objDBO->fetch()){
			$ret = true;
			
			//$this->profile_image_url = $objDBO->profile_image_url;
			foreach($campos as $key => $value){
				$this->datosTweet->$key = utf8_encode($objDBO->$key);
			}
			//$this->datosTweet = $objDBO;
			
			
		}
		$objDBO->free();
		
		return($ret);
	}
	
	/*** vv  POMBO ***/
	
	//Conteo de Tweets
	function getConteoTweets(){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory("TweetGeneral");
		$hashtDBO = DB_DataObject::Factory("TweetHashtag");
		
		$objDBO->selectAdd();
		$objDBO->selectAdd("COUNT(tweet_hashtag.id) as conteo,tweet_hashtag.id,nombre,tag");
		
		$objDBO->groupBy("id");
		
		$objDBO->joinAdd($hashtDBO,"RIGHT");
		
		$ret = false;
		//DB_DataObject::debugLevel(5);
		$objDBO->find();
		$resultados = array();
		$contador = 0;
		
		$totalTweets = 0;
		while($objDBO->fetch()){
			$ret = true;
			//Asigna los valores
			$resultados[$contador]->conteo = $objDBO->conteo;
			$resultados[$contador]->idHashtag = $objDBO->id;
			$resultados[$contador]->nombre = $objDBO->nombre;
			$resultados[$contador]->tag = $objDBO->tag;
			$totalTweets += $objDBO->conteo;
			$contador++;
		}
		
		if($ret){
			$ret = $resultados;
		}
		
		$this->totalTweets = $totalTweets;
		
		//Libera el objeto DBO
		$objDBO->free();
		//DB_DataObject::debugLevel(0);
		return($ret);
	}
	
	//Trae un Tweet q no se ha publicado de un usuario especial
	function getTweetsVip($ultimoArroba = ''){
		//Crea una nueva instancia de Tweets a partir de DataObject
		//DB_DataObject::debugLevel(5);
		$objDBO = DB_DataObject::Factory("TweetGeneral");
		$vipDBO = DB_DataObject::Factory("TweetVip");
		
		$campos = $objDBO->table();
		$objDBO->publicado = 'N';
		
		if($ultimoArroba != ''){
			$vipDBO->whereAdd("arroba <> '$ultimoArroba'");
		}
		
		$vipDBO->selectAdd();
		$vipDBO->selectAdd("tweet_general.*");
		
		$vipDBO->orderBy("fecha DESC");
		$vipDBO->joinAdd($objDBO);
		
		$vipDBO->find();
		$resultados = array();
		$contador = 0;
		$ret = false;
		while($vipDBO->fetch()){
			$ret = true;
			foreach($campos as $key => $value){
				$resultados[$contador]->$key = utf8_decode($vipDBO->$key);
			}
			$contador++;
		}
		
		if($ret){
			$ret = $resultados;
		}
		
		//Libera el objeto DBO
		$vipDBO->free();
		//DB_DataObject::debugLevel(0);
		return($ret);
	}
	
	//Actualiza estado del Tweet
	function setTweetPublicado($idTweet){
		$obj2DBO = DB_DataObject::Factory("TweetGeneral");
		
		$obj2DBO->get($idTweet);
		$obj2DBO->publicado = 'S';
		$obj2DBO->update();
		
		$obj2DBO->free();
		
		return(true);
	}
	
	//Trae el número total de Tweets
	function getNumTotalTweets($tabla = "TweetGeneral"){
		$obj2DBO = DB_DataObject::Factory($tabla);
		
		$obj2DBO->publicado = 'S';
		
		$total = $obj2DBO->count();
		
		$obj2DBO->free();
		
		return($total);
	}
	
	//Trae top Twitteros
	function getTopUsuarios($tabla = "TweetGeneral"){
		//DB_DataObject::debugLevel(5);
		$obj2DBO = DB_DataObject::Factory($tabla);
		
		$obj2DBO->publicado = 'S';
		$obj2DBO->groupBy("from_user");
		$obj2DBO->orderBy("conteo DESC");
		
		$obj2DBO->selectAdd();
		$obj2DBO->selectAdd("COUNT(id) as conteo, from_user");
		
		//DB_DataObject::debugLevel(5);
		$ret = false;
		$obj2DBO->find();
		$resultados = array();
		$contador = 0;
		
		$totalTweets = 0;
		while($obj2DBO->fetch()){
			$ret = true;
			//Asigna los valores
			$resultados[$contador]->conteo = $obj2DBO->conteo;
			$resultados[$contador]->from_user = $obj2DBO->from_user;
			$totalTweets += $obj2DBO->conteo;
			$contador++;
		}
		
		if($ret){
			$ret = $resultados;
		}
		$this->totalTweets = $totalTweets;
		
		//Libera el objeto DBO		
		$obj2DBO->free();
		
		return($ret);
	}

	//Función que retorna el id del últmo valor de arreglo de tweets
	//Devuelve un Double
	function ultimoId($arregloTweets){
		foreach ($arregloTweets[count($arregloTweets)-1] as $key => $value) {
			if($key=="id_str"){
				$ultimoid=$value;	
				break;	
		}
	}
		return $ultimoid;

	}
	//Función que reccorre los status de acuerdo a un termino o hashtag
    function searchUltimoStatus($decodificacion){
    	return $decodificacion['statuses'][count($decodificacion['statuses'])-1]['id_str'];
	}
	//Función que realiza petición a servidor por OAUTH
	function peticionsrv($twitter,$getfield,$ruta,$requestMethod){
			$results = $twitter->setGetfield($getfield)
				 ->buildOauth($ruta, $requestMethod)
				 ->performRequest();
				 printVar($decodificacion);

	return $decodificacion=(array) (object) json_decode($results,true);

	}

	//Defines Twitter´s API URL

	function ruta($dateBgin,$termino,$hashtag,$usuario){

		

		if ($dateBgin ==''){
			$getfield='?screen_name='.$usuario.'&count=200';
			$url=array('https://api.twitter.com/1.1/statuses/user_timeline.json',$getfield,'https://api.twitter.com/1.1/application/rate_limit_status.json'); //max 3200 tweets
		} else {
			$getfield=$this->campoBuscar($dateBgin,$termino,$hashtag);

			$url =array('https://api.twitter.com/1.1/search/tweets.json',$getfield,'https://api.twitter.com/1.1/application/rate_limit_status.json'); //max 500 tweets
		}
		printVar($url);
		return $url;
	}

	//define el nivel de busqueda de https://api.twitter.com/1.1/search/tweets.json
	function campoBuscar($dateBgin,$termino,$hashtag){

		if($dateBgin !=""){
			/*$getfield='?q=#'.$hashtag.'from:oldspiceLa'*//*.'&until='.$dateBgin*/;
			$getfield = '?q=%40'.$hashtag;
            /*$getfield = '?q=+%23'.$hashtag.'+OR+%23'.$hashtag*/
			/*?q=%23freebandnames&since_id=24012619984051000&max_id=250126199840518145&result_type=mixed&count=4*/

		}elseif ($termino !="") {
			$getfield = '?q='.$termino;
		}elseif ($hashtag !="") {
			$getfield = '?q=+%23'.$hashtag;
		}else{
			$getfield = '?q=+%23'.$hashtag.'+OR+%23'.$hashtag;
		}

		return $getfield;
    }
    //Método que recorre registros del url de search/tweets
    function searchFtch($url,$dateBgin,$termino,$hashtag,$decodificacion,$twitter,$requestMethod){
    	$arreglo=array();
    	$contador=1;
    	$ultimoidFinal='';
    	while($contador>0){
    		$ultimoid=$this->searchUltimoStatus($decodificacion);
    		if($ultimoid!=''){
    			$getfield='?q='.$hashtag.'&max_id='.$ultimoid;
    			printVar($getfield);
    			printVar($url,'juli');
				$decodificacion=$this->peticionsrv($twitter,$getfield,$url,$requestMethod); 
				printVar($decodificacion); 
				$contador++;
/*    				 foreach($decodificacion as $key => $value){	
						foreach($value as $llave => $valor){
								if($llave=="id_str"){
									return $valor;
								}
						}
						'?q="'.$hashtag.'"&max_id=since_id=639481329072082944&count=100'
			          }*/	
    	    }
    	    if($contador==8){sleep(900);}
    	    if($ultimoid==$ultimoidFinal){
    	    	return true;}
    	    $ultimoidFinal=$ultimoid;
        }

    }
    //Función que realiza Fetch de datos en timeLine
    function userTimeFtch($url,$usuario,$decodificacion,$twitter,$requestMethod){
    	$arreglo=array();
    	$contador=1;
    	$ultimoidFinal='';
    while($contador>0){
	 	$ultimoid=$decodificacion['search_metadata']['next_results'];	
		 	if($ultimoid!=''){
			 	printVar($ultimoid);
				$getfield='?screen_name='.$usuario.$ultimoid.'&count=200';
				$decodificacion=$this->peticionsrv($twitter,$getfield,$url,$requestMethod);
				unset($decodificacion[0]);
				array_push($arreglo,$decodificacion);
				printVar($arreglo);
				$contador++;
				printVar($contador,'contador');
				sleep(64);
			}

			if ($ultimoidFinal==$ultimoid) {
				$contador=-1;
			}


	 	$ultimoidFinal=$ultimoid;

	 }
	 return $arreglo;
    }


}
?>