<?php

class Tracklist{
	/*	
		A music library is supposed to have multiple user so this
		Tracklist class corresponds to each user. It takes an xml file 
		that contains information about the user's tracklist and turns 
		it into an associative array so it can be easily parsed.
		@param $filename: path to xml file
	*/
	function __construct($userPathInfo){
		//Load xml file
		$xml = simplexml_load_file('library.xml');
		//convert xml file to json
		$json = json_encode($xml);
		//convert json into associative array
		$this->tracklist = json_decode($json, TRUE);
	}
	/*
		Returns the specif track for a given key
		@param $key: the key used to identify the track
		@return: the track stored in the list
	*/
	function getTrack($key){
		if($this->tracklist['tracks'][$key]){
			//return the track with it's key value
			return array ($key => $this->user->tracklist['tracks'][$key]);
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
	/*
		This fuction displays the user's tracks 
	*/
	function displayTracks(){
		$tracks = $this->tracklist['tracks'];

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