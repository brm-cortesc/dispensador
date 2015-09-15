<?php
class guardaTweet {

	/*Funcion para insertar los tweets en la tabla dp_tweet*/
	public function InsertarTweet($campos) {

		//$existe=$this->ConsultarProducto($campos["nit"]);
		//DB_DataObject::debugLevel(3);
		$dbdata = DB_DataObject::Factory('DpTweet');

		$dbdata -> idHashtag = $campos["idHashtag"];
		$dbdata -> idTweet = $campos["idTweet"];
		$dbdata -> arroba = $campos["arroba"];
		$dbdata -> nombreUsuario = $campos["nombreUsuario"];
		$dbdata -> tweet = $campos["tweet"];
		$dbdata -> avatar = $campos["avatar"];
		$dbdata -> fecha = date("Y-m-d H:i:s");

		$dbdata -> insert();

		$dbdata -> free();
		return $dbdata;

		}

		/*Funcion para traer el ultimo idTweet y hacer una búsqueda por parametro*/

	public function traeIdFin($idHashtag){

		//DB_DataObject::debugLevel(1);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory('DpTweet');
		$objDBO -> selectadd();
		$objDBO -> selectadd('MAX(CONVERT(idTweet, SIGNED INTEGER)) AS tweetReciente');
		//$objDBO -> orderBy("idTweet DESC");
		$objDBO -> whereAdd("idHashtag=" . $idHashtag);
		//$objDBO -> limit('1');
		$objDBO -> find();
		$objDBO -> fetch();
		$ret = $objDBO -> tweetReciente;
		//$ret = $ret + 1;
		//Libera el objeto DBO
		$objDBO -> free();
		return $ret;


		}

		public function traeTweets($idHashtag){

	//DB_DataObject::debugLevel(5);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory('DpTweet');
		$objDBO -> selectadd();
		$objDBO -> selectadd('id,idTweet,arroba,nombreUsuario,tweet,avatar,fecha');
		$objDBO -> orderBy("fecha DESC");
		$objDBO -> whereAdd("idHashtag=" . $idHashtag);
		//$objDBO -> limit('1');
		$objDBO -> find();
		
		$count = 0;
		while ($objDBO -> fetch()) {
			$ret[$count] -> id = $objDBO -> id;
			$ret[$count] -> idTweet = $objDBO -> idTweet;
			$ret[$count] -> arroba = $objDBO -> arroba;
			$ret[$count] -> nombreUsuario = $objDBO -> nombreUsuario;
			$ret[$count] -> tweet = $objDBO -> tweet;
			$ret[$count] -> avatar = $objDBO -> avatar;
			$ret[$count] -> fecha = $objDBO -> fecha;
			$count++;
		}
		//$ret = $ret + 1;
		//Libera el objeto DBO
		return $ret;
		$objDBO -> free();


		}

		public function traeHastag(){
		//DB_DataObject::debugLevel(5);
			//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory('DpHashtag');
		$objDBO -> selectadd();
		$objDBO -> selectadd('id,hashtag');
		//$objDBO -> orderBy("idTweet DESC");
		//$objDBO -> limit('1');
		$objDBO -> find();
		
		$count = 0;
		while ($objDBO -> fetch()) {
			$ret[$count] -> id = $objDBO -> id;
			$ret[$count] -> hashtag = $objDBO -> hashtag;
			$count++;
		}
		//$ret = $ret + 1;
		//Libera el objeto DBO
		$objDBO -> free();
		return $ret;
		}
	


	}
?>