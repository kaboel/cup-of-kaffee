<!--
    * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
    * Copyright 2018 faiq.kaboel@gmail.com | In Effect
-->

<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="faiq.kaboel@gmail.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>.barista.</title>
</head>
<link rel="icon" href="../images/kaffee-icon.png">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/all.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/jquery-ui.css">
<link rel="stylesheet" href="../css/jquery-ui.structure.css">
<style>
    body {
        overflow: hidden;
    }
</style>
<body id="admIdx">
    <!-- REMOTE -->
</body>
<script src="../js/jquery-min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
</html>

<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../lib/core.php');
$core = new Core;
$core->__loginVerify();
?>