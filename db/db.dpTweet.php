<?php
/**
 * Table Definition for dp_tweet
 */

class DataObject_DpTweet extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'dp_tweet';                        // table name
    public $id;                              // int(10)  not_null primary_key auto_increment
    public $idHashtag;                       // int(10)  
    public $idTweet;                         // string(255)  
    public $idTweetStr;                      // string(255)  
    public $arroba;                          // string(20)  
    public $nombreUsuario;                   // string(255)  
    public $tweet;                           // string(255)  
    public $avatar;                          // string(255)  
    public $fecha;                           // datetime(19)  binary
    public $source;                          // string(300)  
    public $truncated;                       // string(300)  
    public $inRreplyToStatusId;              // string(255)  
    public $inReplyToStatusIdStr;            // string(255)  
    public $inReplyToUserId;                 // string(255)  
    public $inReplyToUserIdStr;              // string(255)  
    public $inReplyToScreenName;             // string(255)  
    public $idUsuario;                       // string(255)  
    public $idUsuarioStr;                    // string(255)  
    public $location;                        // string(300)  
    public $description;                     // string(300)  
    public $url;                             // string(300)  
    public $protegido;                       // string(300)  
    public $followersCount;                  // string(20)  
    public $friendsCount;                    // string(20)  
    public $listedCount;                     // string(20)  
    public $createdAt;                       // datetime(19)  binary
    public $favouritesCount;                 // string(20)  
    public $utcOffset;                       // string(255)  
    public $timeZone;                        // string(255)  
    public $geoEnabled;                      // string(255)  
    public $verified;                        // string(255)  
    public $statusesCount;                   // string(255)  
    public $lang;                            // string(255)  
    public $contributorsEnabled;             // string(255)  
    public $isTranslator;                    // string(255)  
    public $isTranslationEnabled;            // string(255)  
    public $hasExtendedProfile;              // string(255)  
    public $defaultProfile;                  // string(255)  
    public $defaultProfileImage;             // string(255)  
    public $following;                       // string(255)  
    public $followRequestSent;               // string(255)  
    public $notifications;                   // string(255)  
    public $media_url;                   // string(255)  
    public $aprobado;                   // string(1)  enum

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_DpTweet',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idHashtag' =>  DB_DATAOBJECT_INT,
             'idTweet' =>  DB_DATAOBJECT_STR,
             'idTweetStr' =>  DB_DATAOBJECT_STR,
             'arroba' =>  DB_DATAOBJECT_STR,
             'nombreUsuario' =>  DB_DATAOBJECT_STR,
             'tweet' =>  DB_DATAOBJECT_STR,
             'avatar' =>  DB_DATAOBJECT_STR,
             'fecha' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
             'source' =>  DB_DATAOBJECT_STR,
             'truncated' =>  DB_DATAOBJECT_STR,
             'inRreplyToStatusId' =>  DB_DATAOBJECT_INT,
             'inReplyToStatusIdStr' =>  DB_DATAOBJECT_STR,
             'inReplyToUserId' =>  DB_DATAOBJECT_INT,
             'inReplyToUserIdStr' =>  DB_DATAOBJECT_STR,
             'inReplyToScreenName' =>  DB_DATAOBJECT_STR,
             'idUsuario' =>  DB_DATAOBJECT_STR,
             'idUsuarioStr' =>  DB_DATAOBJECT_STR,
             'location' =>  DB_DATAOBJECT_STR,
             'description' =>  DB_DATAOBJECT_STR,
             'url' =>  DB_DATAOBJECT_STR,
             'protegido' =>  DB_DATAOBJECT_STR,
             'followersCount' =>  DB_DATAOBJECT_STR,
             'friendsCount' =>  DB_DATAOBJECT_STR,
             'listedCount' =>  DB_DATAOBJECT_STR,
             'createdAt' =>  DB_DATAOBJECT_STR,
             'favouritesCount' =>  DB_DATAOBJECT_STR,
             'utcOffset' =>  DB_DATAOBJECT_STR,
             'timeZone' =>  DB_DATAOBJECT_STR,
             'geoEnabled' =>  DB_DATAOBJECT_STR,
             'verified' =>  DB_DATAOBJECT_STR,
             'statusesCount' =>  DB_DATAOBJECT_STR,
             'lang' =>  DB_DATAOBJECT_STR,
             'contributorsEnabled' =>  DB_DATAOBJECT_STR,
             'isTranslator' =>  DB_DATAOBJECT_STR,
             'isTranslationEnabled' =>  DB_DATAOBJECT_STR,
             'hasExtendedProfile' =>  DB_DATAOBJECT_STR,
             'defaultProfile' =>  DB_DATAOBJECT_STR,
             'defaultProfileImage' =>  DB_DATAOBJECT_STR,
             'following' =>  DB_DATAOBJECT_STR,
             'followRequestSent' =>  DB_DATAOBJECT_STR,
             'notifications' =>  DB_DATAOBJECT_STR,
             'media_url' =>  DB_DATAOBJECT_STR,
             'aprobado' =>  DB_DATAOBJECT_STR,
         );
    }

    function keys()
    {
         return array('id');
    }

    function sequenceKey() // keyname, use native, native name
    {
         return array('id', true, false);
    }

    function defaults() // column default values 
    {
         return array(
             'idTweetStr' => '',
             'arroba' => '',
             'nombreUsuario' => '',
             'tweet' => '',
             'avatar' => '',
             'source' => '',
             'truncated' => '',
             'inReplyToStatusIdStr' => '',
             'inReplyToUserIdStr' => '',
             'inReplyToScreenName' => '',
             'idUsuarioStr' => '',
             'location' => '',
             'description' => '',
             'url' => '',
             'protegido' => '',
             'followersCount' => '',
             'friendsCount' => '',
             'listedCount' => '',
             'favouritesCount' => '',
             'utcOffset' => '',
             'timeZone' => '',
             'geoEnabled' => '',
             'verified' => '',
             'statusesCount' => '',
             'lang' => '',
             'contributorsEnabled' => '',
             'isTranslator' => '',
             'isTranslationEnabled' => '',
             'hasExtendedProfile' => '',
             'defaultProfile' => '',
             'defaultProfileImage' => '',
             'following' => '',
             'followRequestSent' => '',
             'notifications' => '',
             'media_url' => '',
             'aprobado' => 'S',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
