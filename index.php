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
		require_once('Library.php');
		include('User.php');

		$tracklist = Library::init();
		$tracklist->displayLibrary();		
	?>
	</form>

</body>
</html>
				
					