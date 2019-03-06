<?php
class Tracklist{

	/*
		This constructor takes an xml file that contains information 
		about the tracklist and turns it into an associative 
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
		This method returns all the tracks the user has stored
		@return: an associative array containing the user's tracklist 
	*/
	function getTracklist(){
		return $this->tracklist['tracks'];
	}
	/*
		Returns the specif track for a given key
		@param $key: the key used to identify the track
		@return: the track stored in the list
	*/
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
	/*
		Add track to user's tracklist
		@param $key: key specific to track
		@param $track: associative array containing track info
	*/
	function addTrack($key, $track){
		$this->tracklist[$key] = $value;

	}
	function displayTracks(){
		$tracks = $this->getTracklist();

		foreach ($tracks as $key => $track) {
			$artwork = $track['albumArtwork'];
			echo "<div>".
				 "<input type=\"checkbox\" name=\"selected[]\" value=\"$key\"/>".
				 "<img src=\"$artwork\" width=\"50\" height=\"50\">".
				 $track['artist'].' - '.$track['title'].
				 "</div><br>";
		}
	}
}
?>
