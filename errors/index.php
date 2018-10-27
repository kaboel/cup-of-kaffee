<!--
    * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
    * Copyright 2018 faiq.kaboel@gmail.com | In Effect
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_GET['errno'])) {
	$errno = $_GET['errno'];
	$error = "";
	switch($errno) {
		case 403 :
			$error = "Access Forbidden";
		break;
		case 404 :
			$error = "Page Not Found";
		break;
		case 500 :
			$error = "Internal Server Error";
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
			<div class="notfound-404">
				<h1>:(</h1>
			</div>
			<h2><?= $errno. " - ". $error ?></h2>
			<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
			<a href="#">home page</a>
		</div>
	</div>
</body>
</html>
