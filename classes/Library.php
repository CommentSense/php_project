<?php
class Library{

	//Singleton class holder for the library
	private static $instance = NULL;
	/*
		This constructor takes an xml file that contains information 
		about all the songs in the library and turns it into an associative 
		array so it can be easily parsed.
	*/
	private function __construct(){
		//Load xml file
		$xml = simplexml_load_file('xml/library.xml');
		//convert xml file to json
		$json = json_encode($xml);
		//convert json into associative array
		$this->library = json_decode($json, TRUE);
	}
	/*
		We want to make sure that there is only one library so the init() function
		allows it to be initialized only once.
	*/
	public static function init(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
	}
	/*
		Returns the specif track for a given key
		@param $key: the key used to identify the track
		@return: the track stored in the list
	*/
	function getTrack($key){
		if($this->library['tracks'][$key]){
			//return the track with it's key value
			return array ($key => $this->user->tracklist['tracks'][$key]);
		}
	}
	/*
		Function that displays the entire library in html
	*/
	function displayLibrary(){
		$tracks = $this->library['tracks'];
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