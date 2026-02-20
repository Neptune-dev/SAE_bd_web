<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>passwordhash</title>
</head>
<body>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
        	$pwd = $_POST["pwd"];
        	$hash = password_hash($pwd, PASSWORD_DEFAULT);
			print "<p>$pwd</p><BR><p>$hash</p>";
		}
	?>
	<form action="#" method="POST">
    	<input type="" name="pwd" required>
    	<button type="submit">Se connecter</button>
	</form>
</body>
</html>