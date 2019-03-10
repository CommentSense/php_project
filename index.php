<?php 
	//starts the library 
	require_once('classes/Library.php');

	//starts session
	session_start();

	//Load the music library
	$library = Library::init();
	$_SESSION['library'] = $library;

	//Load the users available
	$users = loadUsers();		
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<form name="user" method="post" action="home.php">
			
			<?php
				displayUsers($users);
			?>

			<input type="submit" name="submitUser" value="Select User">
			
	</form>

</body>
</html>
				
<?php					
	function loadUsers(){
		//Load the user available
		$xml = simplexml_load_file('xml/users.xml');
		//convert xml file to json
		$json = json_encode($xml);
		//return associative array associative array
		return json_decode($json, TRUE);
	}

	function displayUsers($users){
		// print_r($users);
		foreach ($users as $key => $user) {
			$path = $user['path'];
			echo "<input type='radio' name=\"userPath\" value=\"$path\">$key<br>";


		}
	}
?>