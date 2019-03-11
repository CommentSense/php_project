<?php
class Library{

	//Class holders for the libraries
	private static $instance1 = NULL;
	private static $instance2 = NULL;
	/*
		This constructor takes an xml file that contains information 
		about all the songs in the library and turns it into an associative 
		array so it can be easily parsed.
	*/
	private function __construct($path){
		//Load xml file
		$xml = simplexml_load_file($path);
		//convert xml file to json
		$json = json_encode($xml);
		//convert json into associative array
		$this->library = json_decode($json, TRUE);
	}
	/*
		We want to make sure that there is only two libraries so the init1() function
		allows the first instance to be initialized
	*/
	public static function init1($path){
        if(self::$instance1 == NULL){
            self::$instance1 = new self($path);
        }
        return self::$instance1;
	}
	/*
		We want to make sure that there is only two libraries so the init2() function
		allows the second instance to be initialized
	*/
	public static function init2($path){
        if(self::$instance2 == NULL){
            self::$instance2 = new self($path);
        }
        return self::$instance2;
	}

	/*
		Returns the specif track for a given key
		@param $key: the key used to identify the track
		@return: the track stored in the list
	*/
	function getTrack($key){
		if($this->library['tracks'][$key]){
			//return the track with it's key value
			return array ($key => $this->library['tracks'][$key]);
		}
	}
	/*
		This fuction displays the user's tracks. The string that is echoed
		is formated in html that way we can display it and style it in css.
		The keys for each track are stored in the html itself so when the
		form is posted the keys are passed onto the html 'selected[]' array
	*/
	function displayLibrary(){
		$tracks = $this->library['tracks'];
		foreach ($tracks as $key => $track) {
			$artwork = $track['albumArtwork'];

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
						 			"<p>Release: ".$track['release']."</p>".
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
