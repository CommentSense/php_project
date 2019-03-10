<?php
	include "classes/User.php";
	
	session_start();

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
<body>

	<form name="tracklist" method="post">
		
		<?php
			if(isset($_POST["removeTracks"])){
				// print_r($_POST['selected']);
				$trackKeys = $_POST["selected"];
				print_r($trackKeys);
				$_SESSION['user']->removeTracks($trackKeys);
			}

			$_SESSION['user']->displayTracks();
		?>
		<input type="submit" name="removeTracks" value="Remove Tracks">
	</form>

</body>
</html>