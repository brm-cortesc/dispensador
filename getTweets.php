<?php
 function objectToArray($d) {
	if (is_object($d)) {
		$d = get_object_vars($d);
	}
	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	} else {
		return $d;
	}
}
//https://twitter.com/i/profiles/show/OldSpiceLA/timeline?include_available_features=1&include_entities=1&last_note_ts=531&max_position=610439773023543296&reset_error_state=false
function asd($hastag=null,$since=null){
	$key = 'WDTlXe9etTsofPrDtZskFzKwf';
	$secret = 'YTQp3f2KLC02pTMylDDkfGPVEYq1u886p8FDBdpZHUTTrMNuVT';
   	$api_endpoint2 = ($hastag==null) ? $since :'?q=%40'.$hastag.'&src=savs&max_position&result_type=mixed' ; 
   	$api_endpoint =  'https://api.twitter.com/1.1/search/tweets.json'.$api_endpoint2; 
	// request token
	$basic_credentials = base64_encode($key.':'.$secret);
	$tk = curl_init('https://api.twitter.com/oauth2/token');
	$proxy="172.16.224.4:8080";
	curl_setopt($tk, CURLOPT_PROXY, $proxy);
	curl_setopt($tk, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$basic_credentials, 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'));
	curl_setopt($tk, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
	curl_setopt($tk, CURLOPT_RETURNTRANSFER, true);
	$token = json_decode(curl_exec($tk));
	curl_close($tk);
	// use token
	if (isset($token->token_type) && $token->token_type == 'bearer') {
		$br = curl_init($api_endpoint);
		curl_setopt($br, CURLOPT_PROXY, $proxy);
		curl_setopt($br, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token->access_token));
		curl_setopt($br, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($br);
		curl_close($br);
	  
		// do_something_here_with($data);
		return objectToArray(json_decode($data));
	}
}

echo"<pre>";
$a1=asd("OldSpiceLA",null);
print_r($a1);
$bandera=1;

while($bandera>0){

	$a1=asd(null,$a1['search_metadata']['next_results']);
	/*$a1=asd(null,"?q=%40OldSpiceLA&include_entities=1&result_type=mixed&max_id=".$max_id);*/
	print_r($a1);

	die;

	$n++;
	sleep(30);
	if ($n==3){die;}
}