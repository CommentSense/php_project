<?php
	/*
		This php file is very simple all it does is display the 
		library and calls myMusic.php to handle the the addition
		of tracks.
	*/
	include "classes/User.php";
	include "classes/Library.php";
	session_start();

	//These 2 if statemenst allow the navigation bar to 
	//set the attrbutes for the current library we are using
	if($_GET['load'] == 'Z'){
		$zoundlcoudClass = "class=\"active\"";
		$veatportClass = "";
		$_SESSION['currentLibrary'] = $_SESSION['zoundcloud'];
	}
	if($_GET['load'] == 'V'){
		$zoundlcoudClass = "";
		$veatportClass = "class=\"active\"";
		$_SESSION['currentLibrary'] = $_SESSION['veatport'];
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
       <li class="My Music"><a href="myMusic.php">My Music</a></li>
       <li class="playlists"><a href="playlists.php">My Playlists</a></li>
       <li class="zoundlcoud"><a <?php echo $zoundlcoudClass?> href="musicSource.php?load=Z">Zoundcloud</a></li>
       <li class="veatport"><a <?php echo $veatportClass?> href="musicSource.php?load=V">Veatport</a></li>
       <li class="changeUser"><a href="index.php">Change User</a></li>
     </ul>
   </div>
 </header>

<body>
	<form name="tracklist" method="post" action="myMusic.php">
		<?php
			//Displays the songs available in the current library selected
			$_SESSION['currentLibrary']->displayLibrary();
		?>
		<input type="submit" name="addTracks" value="Add Tracks">
	</form>

</body>
</html>