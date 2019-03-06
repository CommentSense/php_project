<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
	<form>
	<?php  
		include 'tracklist.php';

		$tracklist = new Tracklist('xml/user01.xml');
		$tracklist->displayTracks();		
	?>
	</form>

</body>
</html>
				
					