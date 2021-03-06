<?php
	include "classes/User.php";
	include "classes/Library.php";
	
	session_start();

	//Post to grab the current user if not already set
	if(isset($_POST["submitUser"])){
		$userPath = $_POST["userPath"];
		$user = new User($userPath);
		$_SESSION["user"] = $user;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<header>
   <div class="nav">
     <ul>
       <li class="My Music"><a class="active" href="myMusic.php">My Music</a></li>
       <li class="playlists"><a href="playlists.php">My Playlists</a></li>
       <li class="zoundlcoud"><a href="musicSource.php?load=Z">Zoundcloud</a></li>
       <li class="veatport"><a href="musicSource.php?load=V">Veatport</a></li>
       <li class="changeUser"><a href="index.php">Change User</a></li>
       <!-- <li class="contact"><a href="#">Contact</a></li> -->
     </ul>
   </div>
 </header>

<body>
	<form name="tracklist" method="post">
		
		<?php
			//Post to remove tracks selected by the user
			if(isset($_POST["removeTracks"])){
				//grab the keys of the selected tracks
				$trackKeys = $_POST["selected"];
				//remove tracks from user's tracklist
				$_SESSION['user']->removeTracks($trackKeys);
			}

			//Post to add Track selected from musicSource.php
			if(isset($_POST["addTracks"])){
				//grab the keys of the selected tracks
				$trackKeys = $_POST["selected"];
				foreach ($trackKeys as $key) {
					//get track information from the selected library
					$track = $_SESSION['currentLibrary']->getTrack($key);
					//add track to the user's tracklist
					$_SESSION['user']->addTrack($key, $track);
				}
			}

			if(isset($_POST["addComment"])){
				//grab the keys of the selected tracks
				$trackKeys = $_POST["selected"];
				$comment = $_POST["comment"];
				foreach ($trackKeys as $key) {
					//add track to the user's tracklist
					$_SESSION['user']->addComment($key, $comment);
				}
			}
			//Displays all user's tracks
			$_SESSION['user']->displayTracks();
		?>
		<input type="submit" name="removeTracks" value="Remove Selected Tracks">
		<br><hr>
		<p><font color="white">Add comment to selected tracks:</font></p>
		<textarea cols="50" rows="3" name="comment"></textarea>
		<br><br>
		<input type="submit" name="addComment" value="Comment">
		<br><hr><br>
		<p><b><font color="white">Playlists:</font></b></p>
		<?php
			$_SESSION['user']->displayPlaylists();
		?>
		<br>
		<input type="submit" formaction="playlists.php" name="addToPlaylist" value="Add Selected Tracks To Playlist">
		<br><br><br>
	</form>
	
	
	

</body>
</html>