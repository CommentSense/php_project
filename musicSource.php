<?php
	include "classes/User.php";
	include "classes/Library.php";
	session_start();


	if($_GET['load'] == 'Z'){
		$zoundlcoudClass = "class=\"active\"";
		$veatportClass = "";
	}
	if($_GET['load'] == 'V'){
		$zoundlcoudClass = "";
		$veatportClass = "class=\"active\"";
	}

	// if(isset($_POST["submitUser"])){
	// 	$userPath = $_POST["userPath"];
	// 	$user = new User($userPath);
	// 	$_SESSION["user"] = $user;
	// }
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
       <li class="home"><a href="home.php">Home</a></li>
       <li class="zoundlcoud"><a <?php echo $zoundlcoudClass?> href="musicSource.php?load=Z">Zoundcloud</a></li>
       <li class="veatport"><a <?php echo $veatportClass?> href="musicSource.php?load=V">Veatport</a></li>
       <li class="changeUser"><a href="index.php">Change User</a></li>
       <!-- <li class="contact"><a href="#">Contact</a></li> -->
     </ul>
   </div>
 </header>

<body class="news">
	<form name="tracklist" method="post">
		
		<?php

			if($_GET['load'] == 'Z')
				$_SESSION['zoundcloud']->displayLibrary();
			if($_GET['load'] == 'V')
				$_SESSION['veatport']->displayLibrary();
		?>
		<input type="submit" name="addTracks" value="Add Tracks">
	</form>

</body>
</html>