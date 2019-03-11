<?php

class User{
	/*	
		A music library is supposed to have multiple user so this
		Tracklist class corresponds to each user. It takes an xml file 
		that contains information about the user's tracklist and turns 
		it into an associative array so it can be easily parsed.
		@param $filename: path to xml file
	*/
	function __construct($userPath){
		//Load xml file
		$xml = simplexml_load_file($userPath);
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
	function removeTracks($keys){
		foreach ($keys as $key) {
			unset($this->tracklist['tracks'][$key]);
		}
	}
	/*
		Add track to user's tracklist
		@param $key: key specific to track
		@param $track: associative array containing track info
	*/
	function addTrack($key, $track){
		$this->tracklist['tracks'][$key] = $track[$key];
		$this->tracklist['tracks'][$key]['comment'] = "NEW TRACK!";

	}
	/*
		This fuction displays the user's tracks 
	*/
	function displayTracks(){
		$tracks = $this->tracklist['tracks'];

		foreach ($tracks as $key => $track) {
			$artwork = $track['albumArtwork'];

			echo 	"<div class=\"container\">".
						"<div class=image>".
				 			"<img src=\"$artwork\" width=\"120\" height=\"116\">".
				 		"</div>".
				 		"<div class=text>".

				 			"<div class=container2>".
				 				"<div class=song>".
						 			"<p>".$track['artist'].' - '.$track['title']."</p>".
						 		"</div>".
						 		"<div class=comment>".
						 			"<p>\"".$track['comment']."\"</p>".
						 		"</div>".
					 		"</div>".

					 	"</div>".
				 		"<div class=checkbox>".
				 			"<input type=\"checkbox\" name=\"selected[]\" value=\"$key\"/>".
				 		"</div>".
				 	"</div><br>";
		}
	}

}

?>