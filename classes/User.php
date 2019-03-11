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
		if(isset($this->tracklist['tracks'][$key])){
			//return the track with it's key value
			return $this->tracklist['tracks'][$key];
		}
		else{
			return FALSE;
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
		Add comment to user's track
		@param $key: key specific to track
		@param $track: associative array containing track info
	*/
	function addComment($key, $comment){
		$this->tracklist['tracks'][$key]['comment'] = $comment;
	}
	/*
		Set's the current playlist we are editing
		@param $playlist: name of the playlist to be used
	*/
	function setCurrentPlaylist($playlist){
		$this->tracklist['currentPlaylist'] = $playlist;
	}
	/*
		Returns the current playlist
	*/
	function currentPlaylist(){
		return $this->tracklist['currentPlaylist'];
	}
	/*
		Adds track to user's playlist
		@param $key: key specific to track
		@param $playlist: the playlist to add to
	*/
	function addToPlaylist($key, $playlist){
		//check to see if the track is already on the playlist
		if(in_array($key, $this->tracklist['playlists'][$playlist]['track']))
			return;
		//if it is not already there append it to the playlist
		array_push($this->tracklist['playlists'][$playlist]['track'], $key);
	}
	/*
		This method removes tracks from the users playlist
		@param $keys: array of tracks keys to remove
	*/

	function removeFromPlaylist($keys){
		//grabs name of the current playlist
		$name = $this->tracklist['currentPlaylist'];
		//grabs track of the current playlist
		$tracks = $this->tracklist['playlists'][$name]['track'];

		//iterates and removes tracks related to the key
		$i = 0;
		foreach ($tracks as $track) {
			if(in_array($track, $keys)){
				unset($this->tracklist['playlists'][$name]['track'][$i]);
			}
			$i++;			
		}

	}
	function createPlaylist($name){
		$this->tracklist['playlists'][$name] = array('track' => array());

	}
	function removePlaylist($name){
		unset($this->tracklist['playlists'][$name]);
	}
	/*
		This fuction displays the user's tracks. The string that is echoed
		is formated in html that way we can display it and style it in css.
		The keys for each track are stored in the html itself so when the
		form is posted the keys are passed onto the html 'selected[]' array
	*/
	function displayTracks(){
		//grab all the track from the libray
		$tracks = $this->tracklist['tracks'];

		foreach ($tracks as $key => $track) {
			//grab the path to the tracks artwork
			$artwork = $track['albumArtwork'];

			//echo an html string that contains the information
			//about the track, its keys, and how to format it
			echo 	"<div class=\"container\">".
						"<div class=image>".
				 			"<img src=\"$artwork\" width=\"100\" height=\"96\">".
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
	/*
		This fuction display track by a given key. The string that is echoed
		is formated in html that way we can display it and style it in css.
		The keys for each track are stored in the html itself so when the
		form is posted the keys are passed onto the html 'selected[]' array
		@param $key: the key for a specific track
	*/
	function displaySingleTrack($key){
		//If there is not track do nothing
		if(!$this->getTrack($key)){
			return;
		}
		//grab all the track from the libray
		$track = $this->getTrack($key);
		$artwork = $track['albumArtwork'];

		//echo an html string that contains the information
		//about the track, its keys, and how to format it
		echo 	"<div class=\"container\">".
					"<div class=image>".
			 			"<img src=\"$artwork\" width=\"100\" height=\"96\">".
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
	/*
		This fuction displays the playslist the user has. The string that is echoed
		is formated in html that way we can display it and style it in css. Each time 
		it iterates it creates a radio button the user can select
	*/
	function displayPlaylists(){
		//grad the user's playlists
		$playlists = $this->tracklist['playlists'];
		//if size is zero display empty
		if(sizeof($playlists) == 0)
			echo "<p><font color=\"white\"><b>You have no tracks to display</b></font><br>";
		//iterate radio button in html format
		foreach ($playlists as $key => $playlist) {
			echo 	"<div class=\"containerPlaylist\">".
				 		"<div class=playlist>".
				 			"<input type='radio' name=\"playlist\" value=\"$key\">$key".
				 		"</div>".
				 	"</div>";
		}


	}
}

?>