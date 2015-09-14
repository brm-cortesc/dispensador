<?php

class ManejaTweets{

		//Funci�n trae los hashtag a buscar
	function getHashtags($tipo="KitkatTuitCuenta"){
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
		
		return($ret);
	}

	//Funci�n para insertar un registro
	function setTweetGeneral($tipo="KitkatTuitGeneral"){
		//Crea una nueva instancia de Tweets a partir de DataObject
    //DB_DataObject::debugLevel(1);
		$objDBO = DB_DataObject::Factory($tipo);
		// Trae los campos de la tabla usuario;
		$campos = $objDBO->table();
  		
		$resultado = false;
		//printVar($campos,'campos');
		foreach($campos as $key => $value){
      
			//$objDBO->$key = utf8_encode($this->$key);
			$objDBO->$key = $this->$key;
		}
		$objDBO->fecha = date("Y-m-d H:i:s");

		//Inserta el objeto DBO
		$ret = $objDBO->insert();
		//printVar($ret, 'ret');
		//Libera el objeto DBO
		$objDBO->free();
		
		return($ret);
		
	}
	
	//Funci�n para insertar un registro
	function setPostGeneral($tipo="KitkatTuitGeneral"){
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
	
	//Funci�n env�a Pulso
	function sendTweetGeneral($idHashtag = 13){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory("KitkatTuitGeneral");
		$objDBO->publicado = 'N';
		$objDBO->idHashtag = $idHashtag;
		
		$ret = false;
		$campos = $objDBO->table();
		$objDBO->find();
		if($objDBO->fetch()){
			$ret = true;
			$obj2DBO = DB_DataObject::Factory("KitkatTuitGeneral");
			
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
	
	//Funci�n Trae el �ltimo Tweet Publicado
	function getUltimoTweet($idHashtag ){
		//Crea una nueva instancia de Tweets a partir de DataObject
		$objDBO = DB_DataObject::Factory("KitkatTuitGeneral");
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
		$objDBO = DB_DataObject::Factory("KitkatTuitGeneral");
		$hashtDBO = DB_DataObject::Factory("KitkatTuitCuenta");
		
		$objDBO->selectAdd();
		$objDBO->selectAdd("COUNT(adv_beat_tweet_hashtag.id) as conteo, idUsuario, adv_beat_tweet_hashtag.id,nombre,tag,user_profile_image_url");
		
		$objDBO->groupBy("id");
		$objDBO->groupBy("idUsuario");
		$objDBO->orderBy("conteo DESC");
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
			$resultados[$contador]->idUsuario = $objDBO->idUsuario;
			$resultados[$contador]->user_profile_image_url = $objDBO->user_profile_image_url;
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
		$objDBO = DB_DataObject::Factory("KitkatTuitGeneral");
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
		$obj2DBO = DB_DataObject::Factory("KitkatTuitGeneral");
		
		$obj2DBO->get($idTweet);
		$obj2DBO->publicado = 'S';
		$obj2DBO->update();
		
		$obj2DBO->free();
		
		return(true);
	}
	
	//Trae el n�mero total de Tweets
	function getNumTotalTweets($tabla = "KitkatTuitGeneral"){
		$obj2DBO = DB_DataObject::Factory($tabla);
		
		$obj2DBO->publicado = 'S';
		
		$total = $obj2DBO->count();
		
		$obj2DBO->free();
		
		return($total);
	}
	
	//Trae top Twitteros
	function getTopUsuarios($tabla = "KitkatTuitGeneral"){
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
  function ranking($tabla="KitkatTuitGeneral",$where='',$quincena=null,$contado=NULL){
   //DB_DataObject::debugLevel(1);
    $objDBO = DB_DataObject::Factory($tabla);
    $campos = $objDBO->table();
		$ret = false;
    $contador=0;
    $objDBO->selectAdd();
    $objDBO->selectAdd("COUNT(user_screen_name) AS conteo,user_screen_name AS arroba,user_id,user_profile_image_url_https AS imagen,quincena,MAX(fecha)as fecha");
    if($quincena!="" && $quincena!=null){
      $objDBO->quincena=$quincena;
    }
    if($contado!="" && $contado!=null){
      $objDBO->contado = $contado;
    }
    $objDBO->idCuenta=$where;
    $objDBO->orderBy("conteo DESC");
    $objDBO->groupBy("user_id");
    $objDBO->find();
    while ($objDBO->fetch()) {
      $idUser = $objDBO->user_id;
			$ret[$contador]->conteo   = utf8_encode(stripslashes($objDBO->conteo));
			$ret[$contador]->arroba   = utf8_encode(stripslashes($objDBO->arroba));
			$ret[$contador]->imagen   = utf8_encode(stripslashes($objDBO->imagen));
			$ret[$contador]->fecha    = utf8_encode(stripslashes($objDBO->fecha));
			$ret[$contador]->quincena = utf8_encode(stripslashes($objDBO->quincena));
			$contador++;
		}
		
		//Libera el objeto DBO
		$objDBO->free();

		return ($ret);
  }
  	function actualizaContado($tabla,$arroba,$fecha){
		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory($tabla);
    $objDBO->contado = "S";
    $objDBO->whereAdd("user_screen_name=\"{$arroba}\"");
    $objDBO->whereAdd("fecha <=\"{$fecha}\"");  
    $ret = $objDBO->update(DB_DATAOBJECT_WHEREADD_ONLY);

    
		//printVar($insert);
		//Libera el objeto DBO
		$objDBO->free();
		
		return ($ret);
	}
}
?>