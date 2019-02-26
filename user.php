<?php
class User{

	/*
		
	*/
	function __construct($file){
		//Load xml file
		$xml = simplexml_load_file($file);
		//convert xml file to json
		$json = json_encode($xml);
		//convert json into associative array
		$this->userData = json_decode($json, TRUE);
	}
	function getData(){
		return $this->userData;
	}
}

$user = new User('xml/user01.xml');
$arr = $user->getData();

print_r($arr['track']);

?>