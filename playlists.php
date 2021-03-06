<?php
	include "classes/User.php";
	include "classes/Library.php";
	session_start();
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
       <li class="My Music"><a href="myMusic.php">My Music</a></li>
       <li class="playlists"><a class="active" href="playlists.php">My Playlists</a></li>
       <li class="zoundlcoud"><a href="musicSource.php?load=Z">Zoundcloud</a></li>
       <li class="veatport"><a href="musicSource.php?load=V">Veatport</a></li>
       <li class="changeUser"><a href="index.php">Change User</a></li>
     </ul>
   </div>
 </header>

<body>
	<form name="tracklist" method="post" action="playlists.php">
		<p><font color="white">New Playlist</font>
		<textarea cols="30" rows="1" name="newPlaylistName"></textarea>
		<input type="submit" name="newPlaylist" value="Create New Playlist">
		</p>

		<?php
			//This post helps change the current playlist
			if(isset($_POST["changePlaylist"])){
				//grab the name of the playlist
				$playlist = $_POST["playlist"];
				//set it as the working playlist
				$_SESSION['user']-> setCurrentPlaylist($playlist);
			}
			//handles the removal of track on playlist
			if(isset($_POST["removeTracks"])){
				//grab the keys of the selected tracks
				$trackKeys = $_POST["selected"];
				//remove tracks from user's tracklist
				$_SESSION['user']->removeFromPlaylist($trackKeys);
			}
			//handles adding tracks to playlist from myMusic.php
			if(isset($_POST["addToPlaylist"])){
				//grab the keys of the selected tracks
				$trackKeys = $_POST["selected"];
				//grab the playlist name
				$playlist = $_POST["playlist"];
				 $_SESSION['user']->setCurrentPlaylist($playlist);
				 //iterate and add items to playlist
				foreach ($trackKeys as $key) {
					 $_SESSION['user']->addToPlaylist($key, $playlist);
				}
			}
			//handles creating a new playlist
			if(isset($_POST["newPlaylist"])){
				//grab the playlist name
				$name = $_POST["newPlaylistName"];
				$_SESSION['user']->createPlaylist($name);
			}
			if(isset($_POST["removePlaylist"])){
				$name = $_POST["playlist"];
				$_SESSION['user']->removePlaylist($name);
			}

			echo "<p><b><font color=\"white\"><b>Playlists:</b></font></b><br>";
			//Display User's Playlists
			$_SESSION['user']->displayPlaylists();
		?>
		<input type="submit" name="changePlaylist" value="Change Playlist">
		<input type="submit" name="removePlaylist" value="Remove Playlist">
		<hr>
		<?php
			//Get the name of the playlist
			$playlistName = $_SESSION['user']->currentPlaylist();
			//Get the playlist itself
			$playlistTracks = $_SESSION['user']->tracklist['playlists'][$playlistName]['track'];
			//Displays current playlist
			echo "<p><font size=\"15px\" color=\"white\"><b>".$playlistName."</b></font><br>";
			
			//Displays tracks inside the playlist
			foreach ($playlistTracks as $track) {
				$_SESSION['user']->displaySingleTrack($track);
			}
		?>
		<input type="submit" name="removeTracks" value="Remove Selected Tracks From Playlist">
	</form>

</body>
</html>
<?php


?>