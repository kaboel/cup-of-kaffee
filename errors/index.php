<!--
    * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
    * Copyright 2018 faiq.kaboel@gmail.com | In Effect
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_GET['errno'])) {
	$errno = $_GET['errno'];
	$error = "";
	$ermsg = "";
	switch($errno) {
		case 403	:
			$errno	= "403";
			$error	= "Access Forbidden";
			$ermsg	= "Sorry, The page or resource you were trying to access is absolutely forbidden for some reason.";
		break;
		case 404	:
			$errno	= "404";
			$error	= "Page Not Found";
			$ermsg	= "Sorry, The page you are looking for might have been removed or had its name changed or is temporarily unavailable.";
		break;
		case 500	:
			$errno	= "500";
			$error	= "Internal Server Error";
			$ermsg	= "Sorry, The server encountered an internal error or misconfiguration and was unable to complete your request.";
		break;
		default		:
			$errno	= "404";
			$error	= "Page Not Found";
			$ermsg	= "Sorry, The page you are looking for might have been removed or had its name changed or is temporarily unavailable.";
		break;
	}
} else {
	$errno	= "404";
	$error	= "Page Not Found";
	$ermsg	= "Sorry, The page you are looking for might have been removed or had its name changed or is temporarily unavailable.";
}
?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="author" content="faiq.kaboel@gmail.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>.oops.</title>
</head>
<link rel="icon" href="/cupofkaffee/errors/images/kaffee-icon.png">
<link rel="stylesheet" href="/cupofkaffee/errors/css/style.css">
<body>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<img src="/cupofkaffee/errors/images/kaffee-sad.png" width="180" height="180">
			</div>
			<h1><?= $errno ?><br><small><?= $error ?></small></h1>
			<p><?= $ermsg ?></p>
			<a href="#" onclick="back()">Back To Previous</a>
			<a href="http://127.0.0.1:8080/cupofkaffee/">Home Page</a>
		</div>
	</div>
</body>
<script>
function back() {
	window.history.back();
}
</script>
</html>

