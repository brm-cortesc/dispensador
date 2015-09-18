<?php
class guardaTweet {

	/*Funcion para insertar los tweets en la tabla dp_tweet*/
	public function InsertarTweet($campos) {

		//$existe=$this->ConsultarProducto($campos["nit"]);
		DB_DataObject::debugLevel(3);
		$dbdata = DB_DataObject::Factory('DpTweet');

		$dbdata -> idHashtag = $campos["idHashtag"];
		$dbdata -> idTweetStr = $campos["idTweet"];
		$dbdata -> arroba = $campos["arroba"];
		$dbdata -> nombreUsuario = $campos["nombreUsuario"];
		$dbdata -> tweet = $campos["tweet"];
		$dbdata -> avatar = $campos["avatar"];
		/*Datos tweet*/
		$dbdata -> idTweet= $campos["idTweetInt"];
		$dbdata -> source = $campos['source'];
		$dbdata -> truncated =  $campos['truncated'];
		$dbdata -> inRreplyToStatusId = $campos['in_reply_to_status_id'];
		$dbdata -> inReplyToStatusIdStr = $campos['in_reply_to_status_id_str'];
		$dbdata -> inReplyToUserId = $campos['in_reply_to_user_id'];
		$dbdata -> inReplyToUserIdStr = $campos['in_reply_to_user_id_str'];
		$dbdata -> inReplyToScreenName = $campos['in_reply_to_screen_name'];
		$dbdata -> idUsuario = $campos['idUsuario'];
		$dbdata -> idUsuarioStr = $campos['idUsuarioStr'];
		$dbdata -> location = $campos['location'];
		$dbdata -> description = $campos['description'];
		$dbdata -> url = $campos['url'];
		$dbdata -> protegido = $campos['protected'];
		$dbdata -> followersCount = $campos['followers_count'];
		$dbdata -> friendsCount = $campos['friends_count'];
		$dbdata -> listedCount = $campos['listed_count'];
		$dbdata -> createdAt = $campos['created_at'];
		$dbdata -> favouritesCount = $campos['favourites_count'];
		$dbdata -> utcOffset = $campos['utc_offset'];
		$dbdata -> timeZone = $campos['time_zone'];
		$dbdata -> geoEnabled = $campos['geo_enabled'];
		$dbdata -> verified = $campos['verified'];
		$dbdata -> statusesCount = $campos['statuses_count'];
		$dbdata -> lang = $campos['lang'];
		$dbdata -> contributorsEnabled = $campos['contributors_enabled'];
		$dbdata -> isTranslator = $campos['is_translator'];
		$dbdata -> isTranslationEnabled = $campos['is_translation_enabled'];
		$dbdata -> hasExtendedProfile = $campos['has_extended_profile'];
		$dbdata -> defaultProfile = $campos['default_profile'];
		$dbdata -> defaultProfileImage = $campos['default_profile_image'];
		$dbdata -> following =$campos['following'];
		$dbdata -> followRequestSent = $campos['follow_request_sent'];
		$dbdata -> notifications = $campos['notifications'];
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
		$objDBO -> whereAdd("idHashtag=" . $idHashtag. ' AND aprobado="S"');
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


		/*FUncion para traer tweet aleatorio*/

		public function ramdomTweet($idHashtag){

		DB_DataObject::debugLevel(5);
		//Crea una nueva instancia de $tabla a partir de DataObject
		$objDBO = DB_DataObject::Factory('DpTweet');
		$objDBO -> selectadd();
		$objDBO -> selectadd('id,idTweet,arroba,nombreUsuario,tweet,avatar,fecha');
		$objDBO -> orderBy("RAND()");
		$objDBO -> whereAdd("idHashtag=" . $idHashtag. ' AND aprobado="S"');
		$objDBO -> limit('1');
		$objDBO -> find();
		$objDBO -> fetch();
		return $ret;
		$objDBO -> free();


		}
	


	}
?>