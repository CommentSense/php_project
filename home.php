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
       <li class="home"><a class="active" href="#">Home</a></li>
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
			if(isset($_POST["removeTracks"])){
				$trackKeys = $_POST["selected"];
				$_SESSION['user']->removeTracks($trackKeys);
			}
			if(isset($_POST["addTracks"])){
				$trackKeys = $_POST["selected"];

				foreach ($trackKeys as $key) {
					$track = $_SESSION['currentLibrary']->getTrack($key);
					$_SESSION['user']->addTrack($key, $track);
				}
			}

			$_SESSION['user']->displayTracks();
		?>
		<input type="submit" name="removeTracks" value="Remove Tracks">
	</form>

</body>
</html>