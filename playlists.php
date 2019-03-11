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
       <li class="playlists"><a href="playlists.php">My Playlists</a></li>
       <li class="zoundlcoud"><a href="musicSource.php?load=Z">Zoundcloud</a></li>
       <li class="veatport"><a href="musicSource.php?load=V">Veatport</a></li>
       <li class="changeUser"><a href="index.php">Change User</a></li>
     </ul>
   </div>
 </header>

<body>
	<form name="tracklist" method="post" action="myMusic.php">
		<p><font color="white">New Playlist</font>
		<textarea cols="30" rows="1" name="comment"></textarea>
		<input type="submit" name="newPlaylist" value="Create New Playlist">
		</p>

		<?php
			//Get the name of the playlist
			$playlistName = $_SESSION['user']->currentPlaylist();
			//Get the playlist itself
			$playlistTracks = $_SESSION['user']->tracklist['playlists'][$playlistName]['track'];
			//Display User's Playlists
			$_SESSION['user']->displayPlaylists();
		?>
		<input type="submit" name="changePlaylist" value="Change Playlist">

		<?php
			//Displays current playlist
			echo "<p><font size=\"15\"color=\"white\"><b>".$playlistName."</b></font><br>";
			
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