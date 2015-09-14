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
    public $arroba;                          // string(20)  
    public $tweet;                           // string(255)  
    public $avatar;                          // string(255)  
    public $fecha;                           // datetime(19)  binary

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObject_DpTweet',$k,$v); }

    function table()
    {
         return array(
             'id' =>  DB_DATAOBJECT_INT + DB_DATAOBJECT_NOTNULL,
             'idHashtag' =>  DB_DATAOBJECT_INT,
             'idTweet' =>  DB_DATAOBJECT_STR,
             'arroba' =>  DB_DATAOBJECT_STR,
             'tweet' =>  DB_DATAOBJECT_STR,
             'avatar' =>  DB_DATAOBJECT_STR,
             'fecha' =>  DB_DATAOBJECT_STR + DB_DATAOBJECT_DATE + DB_DATAOBJECT_TIME,
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
             'idTweet' => '',
             'arroba' => '',
             'tweet' => '',
             'avatar' => '',
         );
    }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
