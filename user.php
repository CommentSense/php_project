<?php
class Tracklist{

	/*
		This constructor takes an xml file that contains information 
		about the user's tracklist and turns it into an associative 
		array so it can be easily parsed.
		@param $filename: path to xml file
	*/
	function __construct($filename){
		//Load xml file
		$xml = simplexml_load_file($filename);
		//convert xml file to json
		$json = json_encode($xml);
		//convert json into associative array
		$this->tracklist = json_decode($json, TRUE);
	}
	/*
		@return: an associative array containing the user's tracklist 
	*/
	function getTracklist(){
		return $this->tracklist['tracks'];
	}
	function getTrack($key){
		if($this->tracklist['tracks'][$key]){
			//return the track with it's key value
			return array ($key => $this->tracklist['tracks'][$key]);
		}
	}
	/*
		This method removes track from user's tracklist
		@param $key: the key used to find the track in the associative array
	*/
	function removeTrack($key){
		unset($this->tracklist[$key]);
	}
	function addTrack($key, $track){
		$this->tracklist[$key] = $value;

	}
}

$tracklist = new Tracklist('xml/user01.xml');

$tracks = $tracklist->getTracklist();
print_r($tracklist);
echo '\n\n\n';

$track = $tracklist->getTrack('x2702');  
print_r($track);
?>