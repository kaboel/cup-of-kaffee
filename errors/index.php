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
	$homep = "http://".$_SERVER['HTTP_HOST']."/cupofkaffee/";
	switch($errno) {
		case 403 :
			$errno = "403";
			$error = "Access Forbidden";
			$ermsg = "You don't have permission to access the requested directory.";
		break;
		case 404 :
			$errno = "404";
			$error = "Page Not Found";
			$ermsg = "The page you are looking for might have been removed had its name changed or is temporarily unavailable.";
		break;
		case 500 :
			$errno = "500";
			$error = "Internal Server Error";
			$ermsg = "The server encountered an internal error or misconfiguration and was unable to complete your request.";
		break;
	}
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
			<span><?= $homep ?></span>
			<div class="notfound-404">
				<h1>:(</h1>
			</div>
			<h2><?= $errno. " - ". $error ?></h2>
			<p><?= $ermsg ?></p>
			<a href="#" onclick="back()">Back To Previous</a>
			<a href="<?= $homep ?>">Home Page</a>
		</div>
	</div>
</body>
<script>
function back() {
	window.history.back();
}
</script>
</html>

